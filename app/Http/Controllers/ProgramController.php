<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\GenericNotification;

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

        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        return view('admin.programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        //
    }

    public function join(Request $request, Program $program)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'proof_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('proof_file')) {
            $file = $request->file('proof_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads/applicants'), $fileName);

            $validated['proof_file'] = $fileName;
        }

        ProgramApplication::create([
            'program_id' => $program->program_id,
            'resident_id' => $user->resident->resident_id,
            'proof_file' => $validated['proof_file'],
            'status' => 'Pending',
        ]);

        $program->increment('applicants_count');

        // Notify admin/staff about the request
        $staffs = User::whereIn('role', ['admin', 'staff'])->get();
        $message = "has submitted an application.";

        foreach ($staffs as $staff) {
            $staff->notify(new GenericNotification(
                Auth::user(),
                $message,
                route('admin.programs.index'),
                'program'
            ));
        }

        return redirect()->back()->with('success', 'You have successfully applied to this program!');
    }
}