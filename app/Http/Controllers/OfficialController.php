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
        $officials = Official::paginate(10);

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
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'position' => 'required|in:Barangay Captain,SK Kagawad,Barangay Council',
            'term_start' => 'required|date',
            'term_end' => 'required|date|after:term_start',
            'status' => 'required|in:Active,Inactive',
        ]);

        try {
            Official::create($data);

            if ($request->header('HX-Request')) {
                return response()
                    ->view('admin.officials.table', ['officials' => Official::paginate(10)])
                    ->header('HX-Trigger', 'officialCreated');
            }

            return redirect()->route('admin.officials.index')
                ->with('success', 'Barangay Official created successfully.');
                
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to create official. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Official $official, Request $request)
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

        return view('admin.officials.index', compact('official'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Official $official)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'position' => 'required|in:Barangay Captain,SK Kagawad,Barangay Council',
            'term_start' => 'required|date',
            'term_end' => 'required|date|after:term_start',
            'status' => 'required|in:Active,Inactive',
        ]);

        try {

            $official->update($data);

            if ($request->header('HX-Request')) {
                return response()->view('admin.officials.index', compact('official'))
                ->header('HX-Trigger', 'officialUpdated');
            }

            return redirect()->route('admin.officials.index')->with('success', 'Barangay Official updated successfully.');
                
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update official. Please try again.');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Official $official)
    {
        //
    }
}
