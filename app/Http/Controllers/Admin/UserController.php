<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{

    // list all staff accounts

    public function index()
    {
        $staff = User::where('role', 'staff')->paginate(3);
        return view('admin.users.index', compact('staff'));
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

        return redirect()->route('staff.index')->with('success', 'Staff account created successfully.');

    }

    public function edit($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        return view('admin.users.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $staff->id],
            'phone_number' => ['nullable', 'string', 'max:20'],
        ]);

        $staff->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff account updated successfully.');
    }

    public function destroy($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff account deleted successfully.');
    }

}
