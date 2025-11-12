<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use Illuminate\Http\Request;

class AdminResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::with(['user', 'profile'])
            ->orderBy('resident_id', 'desc')
            ->paginate(10);
        return view('admin.residents.index', compact('residents'));
    }

    public function show($id)
    {
        $resident = Resident::with(['user', 'profile'])->findOrFail($id);
        return view('admin.residents.show', compact('resident'));
    }
}
