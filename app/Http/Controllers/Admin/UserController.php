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
use Illuminate\Validation\Rules;

class UserController extends Controller
{

    // list all staff accounts

    public function index()
    {
        $users = User::whereIn('role', ['admin', 'staff'])->paginate(4);
        return view('admin.users.index', compact('users'));
    }
    // show form to create staff
    public function create()
    {
        return view('admin.users.create');
    }

    // store the staff account
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['nullable', 'string', 'max:20'],
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'role' => 'staff',
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Staff account created successfully.');

    }

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
        // other stats
    ];

    // Get recent activities
    $recent_announcements = Announcement::with('user')
        ->latest()
        ->take(5)
        ->get();

    $recent_activities = Activity::latest()
        ->take(5)
        ->get();

    return view('admin.dashboard', compact('stats', 'recent_announcements', 'recent_activities'));
    }

    public function show(User $staff)
    {
        return response()->json([
            'id' => $staff->id,
            'first_name' => $staff->first_name,
            'last_name' => $staff->last_name,
            'email' => $staff->email,
            'phone_number' => $staff->phone_number,
            'role' => $staff->role,
            'status' => $staff->status ?? 'Active',
            'created_at' => $staff->created_at->format('M d, Y'),
        ]);
    }

    public function update(Request $request, $id)
    {
        $staff = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $staff->id,
            'role' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $staff->name = $validated['name'];
        $staff->email = $validated['email'];
        $staff->role = $validated['role'];

        if (!empty($validated['password'])) {
            $staff->password = bcrypt($validated['password']);
        }

        $staff->save();

        return redirect()->back()->with('success', 'Staff updated successfully!');
    }
}