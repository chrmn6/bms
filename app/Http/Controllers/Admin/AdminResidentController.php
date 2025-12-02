<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use App\Models\Household;
use Illuminate\Http\Request;
use App\Models\User;

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

    public function approve(User $user)
    {
        if ($user->role !== 'resident') {
            abort(403, "Only residents can be approved.");
        }

        $user->update(['status' => 'Active']);
        return back()->with('success', 'Resident approved.');
    }

    public function reject(User $user)
    {
        if ($user->role !== 'resident') {
            abort(403, "Only residents can be rejected.");
        }

        $user->update(['status' => 'Rejected']);
        return back()->with('success', 'Resident rejected.');
    }
}
