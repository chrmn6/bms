<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Resident;
use App\Models\Announcement;
use App\Models\Blotter;
use App\Models\Clearance;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;
use App\Models\Household;

class StaffController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'households_count'        => Household::count(),
            'residents_count'         => Resident::count(),
            'announcements_count'     => Announcement::count(),
            'activities_count'        => Activity::count(),
            'clearances_pending'      => Clearance::where('status', 'pending')->count(),
            'blotter_reports_pending' => Blotter::where('status', 'pending')->count(),
        ];

        $recent_announcements = Announcement::with('user')->latest()->take(5)->get();
        $recent_activities = Activity::latest()->take(5)->get();

        //Population

       $population = DB::table('residents')
        ->join('resident_profiles', 'residents.resident_id', '=', 'resident_profiles.resident_id')
        ->selectRaw("
            MONTH(residents.created_at) as month,
            SUM(CASE WHEN resident_profiles.gender = 'Male' THEN 1 ELSE 0 END) as male,
            SUM(CASE WHEN resident_profiles.gender = 'Female' THEN 1 ELSE 0 END) as female
        ")->groupBy('month')->get();

        $male = [];
        $female = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthData = $population->firstWhere('month', $i);
            $male[] = $monthData->male ?? 0;
            $female[]= $monthData->female ?? 0;
        }

        // Blotter Reports
        $blotter = DB::table('blotters')->select('incident_type', DB::raw('COUNT(*) as total_reports'))
        ->groupBy('incident_type')->get();

        $labels = $blotter->pluck('incident_type');
        $counts = $blotter->pluck('total_reports');

        return view('staff.dashboard', compact('stats','recent_announcements','recent_activities', 'male', 'female', 'labels', 'counts'));
    }
}