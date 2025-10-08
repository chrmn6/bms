<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blotter;
use Illuminate\Support\Facades\Auth;

class BlotterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = Auth::user();

    if ($user->role === 'resident') {
        $blotters = Blotter::where('resident_id', $user->resident->resident_id)->paginate(3);
    } else {
        $blotters = Blotter::all();
    }

    return view('blotters.index', compact('blotters'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Blotter::class);
        return view('blotters.create');
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
        ]);

        $data['resident_id'] = Auth::user()->resident->resident_id;
        $data['user_id'] = null;

        Blotter::create($data);

        return redirect()->route('blotters.index')->with('success', 'Blotter created successfully.');
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
            'status' => 'required|in:processing,approved,rejected,pending'
        ]);

        $blotter->update([
            'status' => $validated['status'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('blotters.index')->with('success', 'Blotter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
