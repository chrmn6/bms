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
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->role === 'resident') {
            $blotters = Blotter::where('resident_id', $user->resident->resident_id)->latest()->paginate(5);
        } else {
            $blotters = Blotter::latest()->paginate(5);
        }

        if ($request->header('HX-Request')) {
            return view('blotters.table', compact('blotters'));
        }

        return view('blotters.index', compact('blotters'));
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
            $file->move(public_path('uploads/blotters'), $fileName);
            $data['image'] = $fileName;
        }

        $data['resident_id'] = Auth::user()->resident->resident_id;
        $data['user_id'] = null;

        Blotter::create($data);

        if ($request->header('HX-Request')) {
            $user = Auth::user();
            $blotters = $user->role === 'resident'
                ? Blotter::where('resident_id', $user->resident->resident_id)->paginate(3)
                : Blotter::paginate(3);

            return view('blotters.table', compact('blotters'));
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
            'status' => 'required|in:pending,investigating,resolved,dismissed'
        ]);

        $blotter->update([
            'status' => $validated['status'],
            'user_id' => Auth::id(),
        ]);

        if ($request->header('HX-Request')) {
            return header('HX-Trigger', json_encode([
                'refreshTable' => true,
                'closeModal' => true, 
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
}
