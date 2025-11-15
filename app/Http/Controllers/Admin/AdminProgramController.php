<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\ProgramApplication;
use App\Models\Resident;

class AdminProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $programs = Program::latest()->get();

        if ($request->header('HX-Request')) {
            return view('admin.programs.card', compact('programs'));
        }
        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'applicants_limit' => 'required|integer|min:1',
            'application_start' => 'required|date',
            'application_end' => 'required|date|after:application_start',
        ]);

        Program::create($validated);

        if ($request->header('HX-Request')) {
            $programs = Program::latest()->get();
            return response()->view('admin.programs.card', compact('programs'))
            ->header('HX-Trigger', json_encode(['refreshTable' => true, 'closeModal' => true, 'programCreated' => true,
            ]));
        }

        return redirect()->route('admin.programs.index')->with('success', 'Program created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $program = Program::findOrFail($id);
        return view('admin.programs.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'applicants_limit' => 'required|integer|min:1',
            'application_start' => 'required|date',
            'application_end' => 'required|date|after:application_start',
        ]);

        $program->update($validated);

        if ($request->header('HX-Request')) {
            $programs = Program::latest()->get();
            return response()->view('admin.programs.card', compact('programs'))->header('HX-Trigger', json_encode([
                'refreshTable' => true,
                'closeModal' => true,
                'programUpdated' => true,
            ]));
        }

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function applicants(Program $program)
    {
        $applicants = ProgramApplication::where('program_id', $program->program_id)
            ->with('resident')
            ->get();

        return view('admin.programs.applicants', compact('program', 'applicants'));
    }

    public function approve($id)
    {
        ProgramApplication::where('id', $id)->update(['status' => 'Approved']);
        return redirect()->route('admin.programs.index')->with('success', 'Applicant approved.');
    }

    public function reject($id)
    {
        ProgramApplication::where('id', $id)->update(['status' => 'Rejected']);
        return redirect()->route('admin.programs.index')->with('success', 'Applicant rejected.');
    }
}
