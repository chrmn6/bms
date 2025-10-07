<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'role:staff'])->except(['index', 'show']);
        $this->middleware('auth')->only(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('viewAny', Activity::class);

        $activities = Activity::with('user')->get();
        return view('activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $this->authorize('create', Activity::class);
        return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {

        $this->authorize('create', Activity::class);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_time' => 'required|date',
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|in:scheduled,completed,canceled',
        ]);

        $data['user_id'] = Auth::id();
        Activity::create($data);

        return redirect()->route('staff.activities.index')->with('success', 'Activity created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        $this->authorize('view', $activity);
        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        $this->authorize('update', $activity);

        return view('activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $this->authorize('update', $activity);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_time' => 'required|date',
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|in:scheduled,completed,canceled',
        ]);

        $activity->update($data);

        return redirect()->route('staff.activities.index')->with('success', 'Activity updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {

        $this->authorize('delete', $activity);
        $activity->delete();

        return redirect()->route('staff.activities.index')->with('success', 'Activity deleted successfully.');
    }
}
