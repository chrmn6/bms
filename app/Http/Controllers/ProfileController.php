<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Household;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $resident = $user->resident;
        $households = Household::all();

        return view('profile.edit', [
            'user' => $user,
            'resident' => $resident,
            'profile' => $resident?->profile,
            'households' => $households,
        ]);
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

    // Update users table including phone_number
        $user->fill($request->validated());
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        $resident = $user->resident;

        if ($resident) {
            // Update residents table
            $resident->update($request->only([
                'middle_name',
                'suffix',
                'place_of_birth',
                'date_of_birth',
                'gender',
                'address',
                'household_id',
            ]));

            // Ensure profile exists
            $profile = $resident->profile ?? $resident->profile()->create([
                'civil_status' => null,
                'citizenship' => null,
                'occupation' => null,
                'education' => null,
            ]);

            // Update profile
            $profile->update($request->only([
                'civil_status',
                'citizenship',
                'occupation',
                'education',
            ]));
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
