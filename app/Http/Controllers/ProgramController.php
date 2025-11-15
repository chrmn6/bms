<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $programs = Program::whereDate('application_start', '<=', now())
            ->whereDate('application_end', '>=', now())
            ->orderByDesc('created_at')
            ->get();

        if ($user && $user->resident) {
            $programs->load(['applicants' => function ($q) use ($user) {
                $q->where('resident_id', $user->resident->resident_id);
            }]);
        }

        return view('programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('programs.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'title'              => 'required|string|max:255',
    //         'description'        => 'nullable|string',
    //         'applicants_limit'   => 'nullable|integer|min:1',
    //         'application_start'  => 'required|date',
    //         'application_end'    => 'required|date|after_or_equal:application_start',
    //     ]);

    //     Program::create($validated);

        
    //     if ($request->header('HX-Request')) {
    //         $programs = Program::latest()->get();
    //         return response()->view('programs.card', compact('programs'))->header('HX-Trigger', json_encode([
    //             'programCreated' => 'Program created successfully!'
    //         ]));
    //     }

    //     return redirect()->route('programs.index')->with('success', 'Program created succesfully');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        return view('programs.show', compact('program'));
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
    // public function update(Request $request, Program $program)
    // {
    //     $validated = $request->validate([
    //         'title'              => 'required|string|max:255',
    //         'description'        => 'nullable|string',
    //         'applicants_limit'   => 'nullable|integer|min:1',
    //         'application_start'  => 'required|date',
    //         'application_end'    => 'required|date|after_or_equal:application_start',
    //     ]);

    //     $program->update($validated);

    //     if ($request->header('HX-Request')) {
    //         $programs = Program::latest()->get();
    //         return response()->view('programs.card', compact('programs'))
    //         ->header('HX-Trigger', 'programUpdated');
    //     }

    //     return redirect()->route('programs.index')->with('success', 'Program status updated successfully');
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Program $program)
    // {
    //     //
    // }

    public function join(Request $request, Program $program)
    {
        $user = Auth::user();

        if (!$user || !$user->resident) {
            return redirect()->back()->with('error', 'Only residents can join programs.');
        }

        $request->validate([
            'proof_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'note' => 'nullable|string|max:255',
        ]);

        // Store the proof file
        $filePath = $request->file('proof_file')->store('proofs', 'public');

        ProgramApplication::create([
            'program_id' => $program->program_id,
            'resident_id' => $user->resident->resident_id,
            'proof_file' => $filePath,
            'status' => 'Pending',
            'note' => $request->note,
        ]);

        $program->increment('applicants_count');

        return redirect()->back()->with('success', 'You have successfully applied to this program!');
    }
}