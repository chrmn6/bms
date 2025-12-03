<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use App\Models\Household;
use Illuminate\Http\Request;

class AdminResidentController extends Controller
{
    public function index(Request $request)
    {
        $query = Resident::with(['user', 'profile', 'household'])->orderBy('resident_id', 'desc');

        // Filter by household
        if ($request->household_filter) {
            $query->where('household_id', $request->household_filter);
        }

        // Filter by gender
        if ($request->gender) {
            $query->whereHas('profile', function ($q) use ($request) {
                $q->where('gender', $request->gender);
            });
        }

        $residents = $query->paginate(20)->withQueryString();
        $households = Household::all();

        return view('admin.residents.index', compact('residents', 'households'));
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
}
