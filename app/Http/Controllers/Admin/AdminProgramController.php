<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use App\Models\ProgramApplication;
use App\Notifications\GenericNotification;
use App\Models\User;
use App\Models\ProgramExpense;

class AdminProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $programs = Program::with('expense.official.resident')->latest()->get();

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
        $officials = \App\Models\Official::all();
        return view('admin.programs.create', compact('officials'));
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
            'amount' => 'required|numeric|min:0',
            'created_by' => 'required|integer',
        ]);

        $program = Program::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'applicants_limit' => $validated['applicants_limit'],
            'application_start' => $validated['application_start'],
            'application_end' => $validated['application_end'],
        ]);

        $official = Auth::user()->official;
        ProgramExpense::create([
            'program_id' => $program->program_id,
            'amount' => $validated['amount'],
            'created_by' => $validated['created_by'],
        ]);

        //SEND NOTIFICATIONS
        $staff = Auth::user();
        $residents = User::where('role', 'resident')->get();
        $message = "has added a new program.";

        foreach ($residents as $resident) {
            $resident->notify(new GenericNotification(
                $staff,
                $message,
                route('programs.index'),
                'program'
            ));
        }

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
    public function show($id)
    {
        $a = ProgramApplication::with('resident')->findOrFail($id);
        
        return view('admin.programs.show', compact('a'));
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
            'amount' => 'required|numeric|min:0',
        ]);

        $program->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'applicants_limit' => $validated['applicants_limit'],
            'application_start' => $validated['application_start'],
            'application_end' => $validated['application_end'],
        ]);

        // Update Expense
        $program->expense->update([
            'amount' => $validated['amount'],
        ]);

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
            ->with('resident')->latest()->get();

        return view('admin.programs.applicants', compact('program', 'applicants'));
    }

    public function approve(Request $request, $id)
    {
        $a = ProgramApplication::findOrFail($id);
        $a->update([
            'status' => 'Approved',
            'note' => $request->note,
        ]);

        $resident = $a->resident->user;
        if ($resident) {
            $resident->notify(new GenericNotification(
                Auth::user(),
                'approved your application.',
                route('programs.index'),
                'program'
            ));
        }


        return redirect()->route('admin.programs.applicants', $a->program_id)->with('success', 'Applicant approved.');
    }

    public function reject(Request $request, $id)
    {
        $a = ProgramApplication::findOrFail($id);
        $a->update([
            'status' => 'Rejected',
            'note' => $request->note,
        ]);

        $resident = $a->resident->user;
        if ($resident) {
            $resident->notify(new GenericNotification(
                Auth::user(),
                'rejected your application.',
                route('programs.index'),
                'program'
            ));
        }

        return redirect()->route('admin.programs.applicants', $a->program_id)->with('success', 'Applicant rejected.');
    }
}
