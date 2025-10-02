<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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
                'phone_number' => $user->phone_number,
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

        return view('residents.edit', ['resident' => $user->resident, 'profile' => $user->resident->profile, 'user' => $user,]);
    }

    
    public function update(Request $request)
    {
        $resident = Auth::user()->resident;
        $user = Auth::user();

        $request->validate([
            'middle_name' => 'nullable|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female',
            'address' => 'nullable|string|max:255',

            'civil_status' => 'nullable|string|max:50',
            'citizenship' => 'nullable|string|max:50',
            'occupation' => 'nullable|string|max:100',
            'education' => 'nullable|string|max:100',
        ]);

        $user->update([
            'phone_number' => $request->phone_number,
        ]);

        $resident->update($request->only([
            'middle_name',
            'suffix',
            'place_of_birth',
            'date_of_birth',
            'gender',
            'address',
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

        return back()->with('success', 'Your profile has been updated.');
    }
}