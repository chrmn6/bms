<?php

namespace App\Http\Controllers;

use App\Models\Official;
use Illuminate\Http\Request;

class OfficialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $officials = Official::with('user')->get();
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
            'full_name' => 'required|string',
            'position' => 'required|in:Barangay Captain, SK Kagawad, Barangay Council',
            'status' => 'nullable|in:scheduled,completed,canceled',
            'term_start' => 'required|date',
            'term_end' => 'required|date',
        ]);

        Official::create($data);

        return redirect()->route('admin.officials.index')->with('success', 'Barangay Official created succesfully.');
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
    public function edit(Official $official)
    {
        return view('admin.officials.edit', compact('official'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Official $official)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Official $official)
    {
        //
    }
}
