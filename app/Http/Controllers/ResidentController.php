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
use App\Models\Phase;

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

        $recent_announcements = Announcement::with('user')->latest()->take(10)->get();
        $recent_activities = Activity::latest()->take(10)->get();
        $clearances = $resident->clearances()->latest()->take(5)->get();
        $blotters = $resident->blotters()->latest()->take(5)->get();

        return view('residents.dashboard', compact('recent_announcements', 'recent_activities', 'clearances', 'blotters'));
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
            'blood_type' => null,
        ]);

        $resident->load(['details', 'profile', 'household', 'attributes', 'phase']);
        $households = Household::all();
        $phases = Phase::all();

        return view('residents.edit', [
            'user' => $user,
            'resident' => $resident,
            'details' => $resident->details,
            'profile' => $resident->profile,
            'attributes' => $resident->attributes,
            'households' => $households,
            'phases' => $phases,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $resident = $user->resident;

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:11',
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
            'blood_type' => 'nullable|string|max:3',
            'household_id' => 'nullable|exists:households,household_id',
            'phase_id' => 'nullable|exists:phases,phase_id',
        ]);

        // Update user info - use $validated array
        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone_number' => $validated['phone_number'],
        ]);

        // Profile
        $profile = $resident->profile ?? $resident->profile()->create([]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads/residents'), $imageName);

            if ($profile->image && file_exists(public_path('storage/uploads/residents/' . $profile->image))) {
                unlink(public_path('storage/uploads/residents/' . $profile->image));
            }

            $profile->image = $imageName;
        }
        $profile->update([
            'place_of_birth' => $validated['place_of_birth'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'gender' => $validated['gender'] ?? null,
        ]);

        // Details
        $details = $resident->details ?? $resident->details()->create([]);
        $details->update([
            'civil_status' => $validated['civil_status'] ?? null,
            'citizenship' => $validated['citizenship'] ?? null,
            'occupation' => $validated['occupation'] ?? null,
            'education' => $validated['education'] ?? null,
        ]);

        // Attributes
        $attributes = $resident->attributes ?? $resident->attributes()->create([
            'voter_status' => 'No',
            'blood_type' => null,
        ]);
        $attributes->update([
            'voter_status' => $validated['voter_status'] ?? 'No',
            'blood_type' => $validated['blood_type'] ?? null,
        ]);

        // Resident
        $resident->update([
            'middle_name' => $validated['middle_name'] ?? null,
            'suffix' => $validated['suffix'] ?? null,
            'household_id' => $validated['household_id'] ?? null,
            'phase_id' => $validated['phase_id'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        return redirect()->route('residents.dashboard')->with('success', 'Profile updated successfully.');
    }
}