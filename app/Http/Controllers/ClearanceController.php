<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Clearance;
use App\Models\Household;

class ClearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->role === 'resident') {
            $clearances = Clearance::where('resident_id', $user->resident->resident_id)->latest()->paginate(10);
        } else {
            $clearances = Clearance::latest()->paginate(10);
        }

        if ($request->header('HX-Request')) {
        return view('clearance.table', compact('clearances'));
        }

        return view('clearance.index', compact('clearances'));
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
        ]);

        $data['resident_id'] = Auth::user()->resident->resident_id;
        $data['status'] = 'pending';
        $data['issued_date'] = null;
        $data['valid_until'] = null;
        $data['remarks'] = null;
        $data['user_id'] = null;

        Clearance::create($data);

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
            'status' => 'required|in:pending,released,rejected,approved',
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

        
        $type = strtolower($clearance->clearance_type);

        $data = [
            'resident' => $resident,
            'resident_profile' => $resident->profile,
            'resident_address' => $resident->address,
            'clearance' => $clearance,
            'issued_date' => $clearance->issued_date ?? now(),
            'valid_until' => $clearance->valid_until,
            'household_number' => $resident->household_number,
            'household' => $household,
            'barangay_name' => 'Barangay Matina Gravahan',
            'city_name' => 'Davao City',
            'barangay_captain' => 'John Doe',
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

            default:
                return back()->with('error', 'Invalid clearance type found.');
        }

        $pdf = Pdf::loadView($view, $data)->setPaper('A4', 'portrait');
        return $pdf->download($filename);
    }
}
