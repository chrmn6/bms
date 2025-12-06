<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use App\Models\Household;
use App\Models\Phase;
use Illuminate\Http\Request;

class AdminResidentController extends Controller
{
    public function index(Request $request)
    {
        $query = Resident::with(['user', 'profile', 'household', 'phase'])->orderBy('resident_id', 'desc');

        // Filter by phase
        if ($request->phase_filter) {
            $query->where('phase_id', $request->phase_filter);
        }

        // Filter by household
        if ($request->household_filter) {
            $query->where('household_id', $request->household_filter);
        }

        // Filter by gender
        if ($request->gender) {
            $query->whereHas('profile', function ($query) use ($request) {
                $query->where('gender', $request->gender);
            });
        }

        // Filter by status
        if ($request->status) {
            $query->whereHas('user', function ($query) use ($request) {
                $query->where('status', $request->status);
            });
        }

        $residents = $query->paginate(20)->withQueryString();
        $households = Household::all();
        $phases = Phase::all();

        return view('admin.residents.index', compact('residents', 'households', 'phases'));
    }

    public function show($id)
    {
        $resident = Resident::with(['user', 'profile'])->findOrFail($id);
        return view('admin.residents.show', compact('resident'));
    }

    public function approve($id)
    {
        $resident = Resident::with('user')->findOrFail($id);

        $resident->user->update([
            'status' => 'Active'
        ]);

        return back()->with('success', 'Resident has been approved.');
    }

    public function reject($id)
    {
        $resident = Resident::with('user')->findOrFail($id);

        $resident->user->update([
            'status' => 'Inactive'
        ]);

        return back()->with('success', 'Resident has been rejected.');
    }
}
