<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $user = Auth::user();

    if ($user->role === 'resident') {
        $clearance = Clearance::where('resident_id', $user->resident->resident_id)->paginate(3);
    } else {
        $clearance = Clearance::paginate(3);
    }

    return view('clearance.index', compact('clearance'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Clearance::class);
        return view('clearance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'clearance_type' => 'required|string|max:255',
            'purpose' => 'required|date',
            'issued_date' => 'required',
            'status' => 'required|string|max:255',
            'remarks' => 'required|string',
        ]);

        $data['resident_id'] = Auth::user()->resident->resident_id;
        $data['user_id'] = null;

        Clearance::create($data);

        return redirect()->route('clearance.index')->with('success', 'Clearance created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Clearance $clearance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clearance $clearance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clearance $clearance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clearance $clearance)
    {
        //
    }
}
