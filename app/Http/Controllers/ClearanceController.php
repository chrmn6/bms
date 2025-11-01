<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->role === 'resident') {
            $clearances = Clearance::where('resident_id', $user->resident->resident_id)->latest()->paginate(5);
        } else {
            $clearances = Clearance::latest()->paginate(5);
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
                ? Clearance::where('resident_id', $user->resident->resident_id)->paginate(3)
                : Clearance::paginate(3);

            return view('clearance.table', compact('clearances'));
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
            return header('HX-Trigger', json_encode([
                'refreshTable' => true,
                'closeModal' => true, 
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
}
