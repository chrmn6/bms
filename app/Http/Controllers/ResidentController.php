<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Activity;
use App\Models\Announcement;
use App\Models\ResidentDetails;
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

        if (!$user->resident) {
            $resident = Resident::create([
                'user_id' => $user->id,
                'middle_name' => null,
                'suffix' => null,
            ]);
            $user->load('resident');
        }

        $resident = $user->resident;

        if (!$resident->profile) {
            $resident->profile()->create([
                'place_of_birth' => null,
                'date_of_birth' => null,
                'gender' => null,
                'image' => null,
            ]);
        }

        $resident->load(['details', 'profile', 'household']);
        $households = Household::all();

        return view('residents.edit', [
            'user' => $user,
            'resident' => $resident,
            'details' => $resident->details,
            'profile' => $resident->profile,
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
            'household_id' => 'nullable|exists:households,household_id',

            'civil_status' => 'nullable|string|max:50',
            'citizenship' => 'nullable|string|max:50',
            'occupation' => 'nullable|string|max:100',
            'education' => 'nullable|string|max:100',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user basic info
        $user->update($request->only(['first_name', 'last_name', 'email']));
        $profile = $resident->profile ?? $resident->profile()->create([]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/residents'), $imageName);

            if ($profile->image && file_exists(public_path('uploads/residents/' . $profile->image))) {
                unlink(public_path('uploads/residents/' . $profile->image));
            }

            $profile->image = $imageName;
        }

        // Update resident basic info
         $profile->update($request->only([
            'place_of_birth',
            'date_of_birth',
            'gender',
        ]));

        // Ensure details record exists
        $details = $resident->details ?? $resident->details()->create([]);
        $details->update($request->only([
            'civil_status',
            'citizenship',
            'occupation',
            'education',
        ]));

        $resident->update($request->only(['middle_name', 'suffix', 'address', 'household_id']));

        return redirect()->route('residents.dashboard')->with('success', 'Profile updated successfully.');
    }

}