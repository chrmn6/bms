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
    public function index()
    {
    $user = Auth::user();

    if ($user->role === 'resident') {
        $clearances = Clearance::where('resident_id', $user->resident->resident_id)->paginate(3);
    } else {
        $clearances = Clearance::paginate(3);
    }

    return view('clearance.index', compact('clearances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Clearance::class);
        return view('clearance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'clearance_type' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
        ]);

        $data['resident_id'] = Auth::user()->resident->resident_id;
        $data['status'] = 'pending';
        $data['issued_date'] = null;
        $data['valid_until'] = null;
        $data['user_id'] = null;

        Clearance::create($data);

        return redirect()->route('clearance.index')->with('success', 'Clearance created successfully.');
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
            'status' => 'required|in:pending,released,rejected,approved'
        ]);

        $clearance->update([
            'status' => $validated['status'],
            'user_id' => Auth::id(),
            'issued_date' => $clearance->issued_date,
            'valid_until' => $clearance->valid_until,
        ]);

        return redirect()->route('clearance.index')->with('success', 'Clearance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clearance $clearance)
    {
        //
    }
}
