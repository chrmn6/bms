<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ResidentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:resident']);
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
        }

        return view('residents.edit', ['resident' => $user->resident]);
    }

    
    public function update(Request $request)
    {
        $resident = Auth::user()->resident;

        $request->validate([
            'middle_name' => 'nullable|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female',
            'address' => 'nullable|string|max:255',
        ]);

        $resident->update($request->only([
            'middle_name',
            'suffix',
            'place_of_birth',
            'date_of_birth',
            'gender',
            'address'
        ]));

        return back()->with('success', 'Your profile has been updated.');
    }
}