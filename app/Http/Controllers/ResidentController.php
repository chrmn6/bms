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

            // profile photo for users
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->update($request->only(['first_name', 'last_name', 'email']));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/residents'), $imageName);

            // Delete old image if it exists
            if ($resident->image && file_exists(public_path('uploads/residents/' . $resident->image))) {
                unlink(public_path('uploads/residents/' . $resident->image));
            }

            $resident->image = $imageName;
            $resident->save();
        }

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