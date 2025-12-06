<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Clearance;
use App\Models\Household;
use App\Models\Phase;
use App\Models\User;
use App\Notifications\GenericNotification;
use App\Models\Official;

class ClearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Clearance::query();
        if ($user->role === 'resident') {
            $query->where('resident_id', $user->resident->resident_id);
        }

        // Year filter
        if ($request->year && $request->year !== 'all') {
            $query->whereYear('created_at', $request->year);
        }

        $clearances = $query->latest()->paginate(10);
        $years = Clearance::selectRaw('YEAR(created_at) as year')->groupBy('year')->orderBy('year', 'desc')->pluck('year');

        
        if ($request->header('HX-Request')) {
        return view('clearance.table', compact('clearances'));
        }

        return view('clearance.index', compact('clearances', 'years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->authorize('create', Clearance::class);
        if ($request->header('HX-Request')) {
            return view('clearance.create');
        }
        return redirect()->route('clearances.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'clearance_type' => 'required|string|max:255',
            'purpose' => 'required|string',
            'payment_method' => 'required|in:Cash,GCash',
            'payment_proof' => 'required_if:payment_method,GCash|nullable|image|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data['resident_id'] = Auth::user()->resident->resident_id;
        $data['status'] = 'pending';
        $data['issued_date'] = null;
        $data['valid_until'] = null;
        $data['remarks'] = null;
        $data['user_id'] = null;
        $data['payment_method'] = $request->payment_method;
        
        // for payment proof
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads/proofs'), $fileName);
            $data['payment_proof'] = $fileName;
        }

        Clearance::create($data);

        // Notify admin/staff about the request
        $staffs = User::whereIn('role', ['admin', 'staff'])->get();
        $message = "submitted a request for clearance.";

        foreach ($staffs as $staff) {
            $staff->notify(new GenericNotification(
                Auth::user(),
                $message,
                route('clearances.index'),
                'clearance'
            ));
        }

        if ($request->header('HX-Request')) {
            $user = Auth::user();
            $clearances = $user->role === 'resident'
                ? Clearance::where('resident_id', $user->resident->resident_id)->paginate(10)
                : Clearance::paginate(10);

            return response()->view('clearance.table', compact('clearances'))->header('HX-Trigger', json_encode([
                'clearanceCreated' => 'Please wait for the admin to process your request.'
            ]));
        }

        return redirect()->route('clearances.index')->with('success', 'Clearance created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Clearance $clearance)
    {
        $this->authorize('view', $clearance);
        return view('clearance.show', compact('clearance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clearance $clearance)
    {
        $this->authorize('update', $clearance);
        return view('clearance.edit', compact('clearance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clearance $clearance)
    {
        $this->authorize('update', $clearance);

        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed',
            'remarks' => 'nullable|string',
            'issued_date' => 'nullable|date',
            'valid_until' => 'nullable|date',
        ]);

        $clearance->update([
            'status' => $validated['status'],
            'user_id' => Auth::id(),
            'issued_date' => $validated['issued_date'] ?? null,
            'valid_until' => $validated['valid_until'] ?? null,
            'remarks' => $validated['remarks'] ?? null,
        ]);

        //SEND NOTIFICATIONS
        $staff = Auth::user();
        $residents = User::where('role', 'resident')->get();
        
        $statusMessages = [
            'pending'   => 'Your clearance request is now pending.',
            'approved'  => 'approved your clearance request.',
            'rejected'  => 'rejected your clearance request.',
            'completed' => 'marked your clearance request as completed.',
        ];
        $message = $statusMessages[$validated['status']];

        foreach ($residents as $resident) {
            $resident->notify(new GenericNotification(
                $staff,
                $message,
                route('clearances.index'),
                'clearance'
            ));
        }

        if ($request->header('HX-Request')) {
            return response()->noContent()->header('HX-Trigger', json_encode([
                'refreshTable' => true,
                'closeModal' => true, 
                'clearanceUpdated' => 'Notify the resident regarding the status update.'
            ]));
        }

        return redirect()->route('clearances.index')->with('success', 'Clearance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clearance $clearance)
    {
        //
    }

    public function clearancePDF($clearance_id)
    {
        $clearance = Clearance::with(['resident.user'])->findOrFail($clearance_id);
        $resident = $clearance->resident;
        $household = Household::find($resident->household_number);
        $phase = Phase::find($resident->phase_number);

        $official = Official::where('position', 'Barangay Captain')->where('status', 'Active')->first();

        
        $type = strtolower($clearance->clearance_type);

        $data = [
            'resident' => $resident,
            'resident_profile' => $resident->profile,
            'resident_address' => $resident->address,
            'clearance' => $clearance,
            'issued_date' => $clearance->issued_date ?? now(),
            'valid_until' => $clearance->valid_until,
            'household_number' => $resident->household_number,
            'phase_number' => $resident->phase_number,
            'household' => $household,
            'phase' => $phase,
            'official' => $official,
            'barangay_name' => 'Barangay Matina Gravahan',
            'city_name' => 'Davao City',
        ];

        switch ($type) {
            case 'barangay clearance':
                $view = 'pdf.barangay_clearance';
                $filename = "BarangayClearance_{$resident->full_name}.pdf";
                break;

            case 'business clearance':
                $view = 'pdf.business_clearance';
                $filename = "BusinessClearance_{$resident->full_name}.pdf";
                break;

            case 'residency clearance':
                $view = 'pdf.residency_clearance';
                $filename = "ResidencyClearance_{$resident->full_name}.pdf";
                break;

            case 'barangay indigency':
                $view = 'pdf.barangay_indigency';
                $filename = "BarangayIndigency_{$resident->full_name}.pdf";
                break;

            default:
                return back()->with('error', 'Invalid clearance type found.');
        }

        $pdf = Pdf::loadView($view, $data)->setPaper('A4', 'portrait');
        return $pdf->download($filename);
    }
}
