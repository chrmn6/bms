<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $programs = Program::latest()->get();

        if ($request->header('HX-Request')) {
            return view('programs.card', compact('programs'));
        }

        return view('programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'program_date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:255',
            'attendees_count' => 'nullable|integer|min:0',
            'status' => 'nullable|in:Planned,Ongoing,Completed',
        ]);

        Program::create($validated);

        if ($request->header('HX-Request')) {
            $programs = Program::latest()->get();
            return response()->view('programs.card', compact('programs'))->header('HX-Trigger', json_encode([
                'programCreated' => 'Program created successfully!'
            ]));
        }

        return redirect()->route('programs.index')->with('success', 'Program created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        return view('programs.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'status' => 'required|in:Planned,Ongoing,Completed,Cancelled',
        ]);

        $program->update($validated);

        if ($request->header('HX-Request')) {
            $programs = Program::latest()->get();
            return response()->view('programs.card', compact('programs'))
            ->header('HX-Trigger', 'programUpdated');
        }

        return redirect()->route('programs.index')->with('success', 'Program status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        //
    }

    public function join(Program $program, Request $request)
    {
        $resident = auth()->user()->resident;

        if (!$program->residents->contains($resident->resident_id)) {
            $program->residents()->attach($resident->resident_id);
            $program->increment('attendees_count');
        }

        if ($request->header('HX-Request')) {
            $program->load('residents');
            
            $programs = collect([$program]);
            
            return response()
                ->view('programs.card', compact('programs'))
                ->header('HX-Trigger', 'programJoined');
        }

        return back()->with('success', 'You have joined the program!');
    }
}
