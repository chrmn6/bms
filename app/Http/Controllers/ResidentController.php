<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Household;

class ResidentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:resident']);
    }

    public function edit()
    {
        $user = Auth::user();

        if (!$user->resident) {
            $resident = Resident::create([
                'user_id' => $user->id,
                'middle_name' => null,
                'suffix' => null,
                'place_of_birth' => null,
                'date_of_birth' => null,
                'gender' => null,
                'address' => null,
                'household_id' => null,
            ]);
            $user->load('resident');
        }

        if (!$user->resident->profile) {
            $user->resident->profile()->create([
                'civil_status' => null,
                'citizenship' => null,
                'occupation' => null,
                'education' => null,
            ]);
            $user->resident->load('profile');
        }

        
        $households = Household::all();

        return view('residents.edit', ['user' => $user, 'resident' => $user->resident, 'profile' => $user->resident->profile, 'households' => $households,]);
    }

    
    public function update(Request $request)
    {
        $user = Auth::user();
        $resident = Auth::user()->resident;

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female',
            'address' => 'nullable|string|max:255',
            'household_id' => 'nullable|exists:households,household_id',

            'civil_status' => 'nullable|string|max:50',
            'citizenship' => 'nullable|string|max:50',
            'occupation' => 'nullable|string|max:100',
            'education' => 'nullable|string|max:100',
        ]);

        $user->update($request->only(['first_name', 'last_name', 'email']));

        $resident->update($request->only([
            'middle_name',
            'suffix',
            'place_of_birth',
            'date_of_birth',
            'gender',
            'address',
            'household_id',
        ]));

        $profile = $resident->profile ?? $resident->profile()->create([
            'civil_status' => null,
            'citizenship' => null,
            'occupation' => null,
            'education' => null,
        ]);

        $profile->update($request->only([
            'civil_status',
            'citizenship',
            'occupation',
            'education'
        ]));

        return redirect()->route('residents.dashboard')->with('success', 'Profile updated successfully.');
    }
}