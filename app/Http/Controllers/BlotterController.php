<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blotter;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\GenericNotification;
use Barryvdh\DomPDF\Facade\Pdf;

class BlotterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Blotter::query();
        if ($user->role === 'resident') {
            $query->where('resident_id', $user->resident->resident_id);
        }

        // Year filter
        if ($request->year && $request->year !== 'all') {
            $query->whereYear('created_at', $request->year);
        }

        $blotters = $query->latest()->paginate(10);
        $years = Blotter::selectRaw('YEAR(created_at) as year')->groupBy('year')->orderBy('year', 'desc')->pluck('year');

        if ($request->header('HX-Request')) {
            return view('blotters.table', compact('blotters'));
        }

        return view('blotters.index', compact('blotters', 'years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->authorize('create', Blotter::class);
        if ($request->header('HX-Request')) {
            return view('blotters.create');
        }

        return redirect()->route('blotters.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'incident_type' => 'required|string|max:255',
            'incident_date' => 'required|date',
            'incident_time' => 'required',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads/blotters'), $fileName);
            $data['image'] = $fileName;
        }

        $data['resident_id'] = Auth::user()->resident->resident_id;
        $data['user_id'] = null;

        Blotter::create($data);

        // Notify admin/staff about the request
        $staffs = User::whereIn('role', ['admin', 'staff'])->get();
        $message = "has filed a report.";

        foreach ($staffs as $staff) {
            $staff->notify(new GenericNotification(
                Auth::user(),
                $message,
                route('blotters.index'),
                'blotter'
            ));
        }

        if ($request->header('HX-Request')) {
            $user = Auth::user();
            $blotters = $user->role === 'resident'
                ? Blotter::where('resident_id', $user->resident->resident_id)->paginate(10)
                : Blotter::paginate(10);

            return response()->view('blotters.table', compact('blotters'))->header('HX-Trigger', json_encode([
                'blotterCreated' => 'Please wait for the admin to contact <br> you regarding your report.'
            ]));
        }

        return redirect()->route('blotters.index')->with('success', 'Blotter report filed successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blotter $blotter)
    {
        $this->authorize('view', $blotter);
        return view('blotters.show', compact('blotter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blotter $blotter)
    {
        $this->authorize('update', $blotter);

        return view('blotters.edit', compact('blotter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blotter $blotter)
    {
        $this->authorize('update', $blotter);

        $validated = $request->validate([
            'status' => 'required|in:pending,resolved,dismissed'
        ]);

        $blotter->update([
            'status' => $validated['status'],
            'user_id' => Auth::id(),
        ]);

        //SEND NOTIFICATIONS
        $staff = Auth::user();
        $residents = User::where('role', 'resident')->get();
        
        $statusMessages = [
            'pending'   => 'Your blotter report is now pending.',
            'resolved'  => 'Your blotter report has been resolved.',
            'dismissed'  => 'Your blotter report has been dismissed.',
        ];
        $message = $statusMessages[$validated['status']];

        foreach ($residents as $resident) {
            $resident->notify(new GenericNotification(
                $staff,
                $message,
                route('blotters.index'),
                'blotter'
            ));
        }

        if ($request->header('HX-Request')) {
            return response()->noContent()->header('HX-Trigger', json_encode([
                'refreshTable' => true,
                'closeModal' => true,
                'blotterUpdated' => 'Notify resident about the status update.'
            ]));
        }

        return redirect()->route('blotters.index')->with('success', 'Blotter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function blotterTranscript($blotter)
    {
        $blotter = Blotter::with(['resident.user'])->findOrFail($blotter);

        $data = [
        'blotter' => $blotter,
        'barangay_name' => 'Barangay Matina Gravahan',
        'city_name' => 'Davao City',
        'barangay_captain' => 'John Doe',
        ];

        $pdf = Pdf::loadView('pdf.blotter_transcript', $data)->setPaper('A4', 'portrait');
        return $pdf->stream("BlotterReport_{$blotter->resident->full_name}.pdf");
    }

    public function blotterPrintAll()
    {
        $blotters = Blotter::whereIn('status', ['resolved', 'dismissed'])->orderBy('created_at', 'desc')->get();

        $data = [
            'blotters' => $blotters,
            'barangay_name' => 'Barangay Matina Gravahan',
            'city_name' => 'Davao City',
            'barangay_captain' => 'John Doe',
        ];

        $pdf = Pdf::loadView('pdf.blotters_list', $data)->setPaper('A4', 'portrait');

        return $pdf->download('BlotterReports.pdf');
    }

}
