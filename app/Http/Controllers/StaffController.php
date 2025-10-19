<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resident;
use App\Models\Announcement;
use App\Models\Blotter;
use App\Models\Clearance;
use App\Models\Activity;

class StaffController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'users_count' => User::count(),
            'staff_count' => User::where('role', 'staff')->count(),
            'residents_count' => Resident::count(),
            'announcements_count' => Announcement::count(),
            'activities_count' => Activity::count(),
            'clearances_pending' => Clearance::where('status', 'pending')->count(),
            'blotter_reports_pending' => Blotter::where('status', 'pending')->count(),
        ];

        $recent_announcements = Announcement::with('user')->latest()->take(5)->get();
        $recent_activities = Activity::latest()->take(5)->get();

        return view('staff.dashboard', compact('stats', 'recent_announcements', 'recent_activities'));
    }
}