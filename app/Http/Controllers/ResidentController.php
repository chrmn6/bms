<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Activity;
use App\Models\Announcement;
use App\Models\Clearance;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Household;

class ResidentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:resident']);
    }

    public function index()
    {
        $user = Auth::user();
        $resident = Resident::where('user_id', $user->id)->first();

        if (!$resident) {
            return redirect()->route('residents.edit')->with('error', 'No resident profile found. Please complete your profile information.');
        }

        $recent_announcements = Announcement::with('user')->latest()->take(10)->get();
        $recent_activities = Activity::latest()->take(10)->get();
        $clearances = $resident->clearances()->latest()->take(5)->get();

        return view('residents.dashboard', compact('resident', 'recent_announcements', 'recent_activities', 'clearances'));
    }

        public function edit()
    {
        $user = Auth::user();

        // Ensure resident exists
        $resident = $user->resident ?? $user->resident()->create([
            'middle_name' => null,
            'suffix' => null,
        ]);

        // Ensure profile exists
        $resident->profile ?? $resident->profile()->create([
            'place_of_birth' => null,
            'date_of_birth' => null,
            'gender' => null,
            'image' => null,
        ]);

        // Ensure attributes exist with defaults
        $resident->attributes ?? $resident->attributes()->create([
            'voter_status' => 'No',
            'pwd_status' => 'No',
            'senior' => 'No',
            'blood_type' => null,
        ]);

        $resident->load(['details', 'profile', 'household', 'attributes']);
        $households = Household::all();

        return view('residents.edit', [
            'user' => $user,
            'resident' => $resident,
            'details' => $resident->details,
            'profile' => $resident->profile,
            'attributes' => $resident->attributes,
            'households' => $households,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $resident = $user->resident;

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'voter_status' => 'nullable|in:Yes,No',
            'pwd_status' => 'nullable|in:Yes,No',
            'senior' => 'nullable|in:Yes,No',
            'blood_type' => 'nullable|string|max:3',
            'household_id' => 'nullable|exists:households,household_id',
        ]);

        // Update user info
        $user->update($request->only(['first_name', 'last_name', 'email']));

        // Profile
        $profile = $resident->profile ?? $resident->profile()->create([]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/residents'), $imageName);

            if ($profile->image && file_exists(public_path('uploads/residents/' . $profile->image))) {
                unlink(public_path('uploads/residents/' . $profile->image));
            }

            $profile->image = $imageName;
        }
        $profile->update($request->only(['place_of_birth', 'date_of_birth', 'gender']));

        // Details
        $details = $resident->details ?? $resident->details()->create([]);
        $details->update($request->only(['civil_status', 'citizenship', 'occupation', 'education']));

        // Attributes
        $attributes = $resident->attributes ?? $resident->attributes()->create([
            'voter_status' => 'No',
            'pwd_status' => 'No',
            'senior' => 'No',
            'blood_type' => null,
        ]);
        $attributes->update($request->only(['voter_status', 'pwd_status', 'senior', 'blood_type']));

        // Resident
        $resident->update($request->only(['middle_name', 'suffix', 'household_id', 'address']));

        return redirect()->route('residents.dashboard')->with('success', 'Profile updated successfully.');
    }

}