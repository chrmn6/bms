<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Resident;
use App\Models\Household;
use App\Models\ResidentProfile;
use App\Models\ResidentDetails;
use App\Models\ResidentAttributes;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(): View
    {
        $households = Household::all();
        return view('auth.register', compact('households'));
    }

    /**
     * Handle registration.
     */
    public function store(Request $request): RedirectResponse
    {
            $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|string|lowercase|email|max:255|unique:users',
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number'  => 'nullable|string|max:11',

            'middle_name'   => 'nullable|string|max:255',
            'suffix'        => 'nullable|string|max:255',
            'place_of_birth'=> 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender'        => 'nullable|in:Male,Female',
            'address'       => 'nullable|string|max:255',

            'civil_status'  => 'nullable|in:Single,In A Relationship,Married,Widowed,Divorced',
            'citizenship'   => 'nullable|string|max:50',
            'occupation'    => 'nullable|in:Self-Employed,Unemployed,Employed',
            'education'     => 'nullable|string|max:100',

            'voter_status'  => 'nullable|in:Yes,No',
            'blood_type'    => 'nullable|string|max:3',

            'household_id'  => 'nullable|exists:households,household_id',
        ]);

        $user = User::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'role'         => 'resident',
            'status' => 'Pending',
        ]);

        $resident = Resident::create([
            'user_id'       => $user->id,
            'household_id'  => $request->household_id,
            'middle_name'   => $request->middle_name,
            'suffix'        => $request->suffix,
            'address'       => $request->address,
        ]);

        ResidentProfile::create([
            'resident_id'   => $resident->resident_id,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth'  => $request->date_of_birth,
            'gender'         => $request->gender,
        ]);

        ResidentDetails::create([
            'resident_id'   => $resident->resident_id,
            'civil_status'  => $request->civil_status,
            'citizenship'   => $request->citizenship,
            'occupation'    => $request->occupation,
            'education'     => $request->education,
        ]);

        ResidentAttributes::create([
            'resident_id'   => $resident->resident_id,
            'voter_status'  => $request->voter_status,
            'blood_type'    => $request->blood_type,
        ]);

        event(new Registered($user));
        // Auth::login($user);

        return redirect()->route('login')->with('status', 'Registration successful! Please wait for admin approval.');
    }
}