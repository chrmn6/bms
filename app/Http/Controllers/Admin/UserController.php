<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Resident;
use App\Models\Announcement;
use App\Models\Blotter;
use App\Models\Clearance;
use App\Models\Activity;
use App\Models\Household;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of all admin and staff users.
     */
    public function index(Request $request)
    {
        $users = User::whereIn('role', ['admin', 'staff'])->paginate(5);

        if ($request->headers->has('HX-Request')) {
            return view('admin.users.table', compact('users'));
        }

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new staff user.
     */
    public function create(Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('admin.users.create');
        }

        return redirect()->route('admin.staff.index');
    }

    /**
     * Store a newly created staff user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|confirmed|min:6',
            'phone_number' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/users'), $fileName);
            $validated['image'] = $fileName;
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'staff';

        User::create($validated);

        
        if ($request->header('HX-Request')) {
            $users = User::whereIn('role', ['admin', 'staff'])->latest()->paginate(5);

            return response()->view('admin.users.table', compact('users'))->header('HX-Trigger', json_encode([
                'staffCreated' => 'Staff account created successfully!'
            ]));
        }
        return redirect()->route('admin.staff.index')->with('success', 'Staff added successfully!');
    }

    /**
     * Display the dashboard with stats.
     */

    public function dashboard()
    {
        $stats = $this->getStats();
        $populationData = $this->getPopulationData();
        $blotter = $this->getBlotter();

        return view('dashboard', [
            'stats' => $stats,
            'male' => $populationData['male'],
            'female' => $populationData['female'],
            'locations' => $blotter['locations'],
            'series' => $blotter['series'],
        ]);
    }

    // === Stats Section ===
    protected function getStats()
    {
        return [
            'households_count'        => Household::count(),
            'residents_count'         => Resident::count(),
            'clearances_pending'      => Clearance::where('status', 'pending')->count(),
            'blotter_reports_pending' => Blotter::where('status', 'pending')->count(),
        ];
    }

    // === Population Section ===
    protected function getPopulationData()
    {
        $residents = DB::table('residents')
            ->join('resident_profiles', 'residents.resident_id', '=', 'resident_profiles.resident_id')
            ->select('resident_profiles.gender')
            ->get();

        $male = $residents->where('gender', 'Male')->count();
        $female = $residents->where('gender', 'Female')->count();

        return compact('male', 'female');
    }

    // === Blotter Section ===
    public function getBlotter()
    {
        $blotters = DB::table('blotters')
        ->select('location', 'incident_type', DB::raw('COUNT(*) as total'))
        ->groupBy('location', 'incident_type')
        ->get();

        $locations = $blotters->pluck('location')->unique()->values();
        $types = $blotters->pluck('incident_type')->unique()->values();

        $series = [];
        foreach ($types as $type) {
            $data = [];
            foreach ($locations as $location) {
                $record = $blotters->where('location', $location)
                ->where('incident_type', $type)
                ->first();
                $data[] = $record ? $record->total : 0;
            }
            $series[] = [
                'name' => $type,
                'data' => $data
            ];
        }

        return compact('locations', 'series');
    }


    /**
     * Display the specified user details (used for HTMX modal).
     */
    public function show(User $staff)
    {
        return view('admin.users.show', compact('staff'));
    }
}