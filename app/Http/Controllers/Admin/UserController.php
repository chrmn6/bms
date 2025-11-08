<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Resident;
use App\Models\Announcement;
use App\Models\Blotter;
use App\Models\Clearance;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $stats = [
            'users_count'             => User::count(),
            'staff_count'             => User::where('role', 'staff')->count(),
            'residents_count'         => Resident::count(),
            'announcements_count'     => Announcement::count(),
            'activities_count'        => Activity::count(),
            'clearances_pending'      => Clearance::where('status', 'pending')->count(),
            'blotter_reports_pending' => Blotter::where('status', 'pending')->count(),
        ];

        $recent_announcements = Announcement::with('user')->latest()->take(5)->get();
        $recent_activities = Activity::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_announcements', 'recent_activities'));
    }

    /**
     * Display the specified user details (used for HTMX modal).
     */
    public function show(User $staff)
    {
        return view('admin.users.show', compact('staff'));
    }
}