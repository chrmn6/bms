<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use Illuminate\Http\Request;

class AdminResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::with(['user', 'profile', 'attributes'])
            ->orderBy('resident_id', 'desc')
            ->paginate(20);
        return view('admin.residents.index', compact('residents'));
    }

    public function show($id)
    {
        $resident = Resident::with(['user', 'profile'])->findOrFail($id);
        return view('admin.residents.show', compact('resident'));
    }

    public function approve($id)
    {
        $resident = Resident::findOrFail($id);
        
        if ($resident->is_approved) {
            return back()->with('info', 'This resident is already approved.');
        }
        
        $resident->update(['is_approved' => true]);
        
        return back()->with('success', 'Resident approved successfully!');
    }
}
