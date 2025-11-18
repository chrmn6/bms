<?php

namespace App\Http\Controllers;

use App\Models\Official;
use Illuminate\Http\Request;

class OfficialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $officials = Official::latest()->paginate(10);

        if ($request->headers->has('HX-Request')) {
            return view('admin.officials.table', compact('officials'));
        }

        return view('admin.officials.index', compact('officials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('admin.officials.create');
        }

        return view('admin.officials.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'position' => 'required|in:Barangay Captain,SK Kagawad,Barangay Council',
            'term_start' => 'required|date',
            'term_end' => 'nullable|date|after:term_start',
            'status' => 'required|in:Active,Inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads/users'), $fileName);
            $validated['image'] = $fileName;
        }

        Official::create($validated);

        if ($request->header('HX-Request')) {
            return response()
                ->view('admin.officials.table', ['officials' => Official::paginate(10)])
                ->header('HX-Trigger', 'officialCreated');
        }

        return redirect()->route('admin.officials.index')->with('success', 'Barangay Official created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Official $official)
    {
        return view('admin.officials.show', compact('official'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Official $official, Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('admin.officials.edit', compact('official'));
        }

        return redirect()->route('admin.officials.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Official $official)
    {
        $validated = $request->validate([
            'term_end' => 'required|date|after:term_start',
            'status' => 'required|in:Active,Inactive',
        ]);
        
        $official->update($validated);

        if ($request->header('HX-Request')) {
            return response()->view('admin.officials.table', ['officials' => Official::paginate(10)])
            ->header('HX-Trigger', json_encode([
                'officialUpdated' => 'Barangay Official account updated successfully!',
                'refreshTable' => true,
            ]));
        }

        return redirect()->route('admin.officials.index')->with('success', 'Barangay Official updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Official $official)
    {
        //
    }
}
