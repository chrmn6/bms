<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use App\Notifications\GenericNotification;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:staff')->only(['create', 'store', 'edit', 'update', 'destroy']);
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
    public function create(Request $request)
    {

        $this->authorize('create', Activity::class);

        $date = $request->query('date');

        if ($request->header('HX-Request')) {
            return view('activities.create', compact('date'));
        }

        return view('activities.index');
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
            'status' => 'nullable|in:Planned,Completed,Cancelled',
        ]);

        $data['user_id'] = Auth::id();
        $activity = Activity::create($data);

        // Send notification
        $staff = Auth::user();
        $residents = User::where('role', 'resident')->get();
        foreach ($residents as $resident) {
            $resident->notify(new GenericNotification(
                $staff,
                'posted a new activity.',
                route('activities.index'),
                'activity'
            ));
        }

        if ($request->header('HX-Request')) {
        return response()->view('activities.create')->header('HX-Trigger', json_encode([
                'activityCreated' => 'Activity created successfully!'
            ]));
        }

        return redirect()->route('activities.index')->with('success', 'Activity created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity, Request $request)
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
            'status' => 'nullable|in:Planned,Completed,Cancelled',
        ]);

        $activity->update($data);

        if ($request->header('HX-Request')) {
        return response('', 200)
            ->header('HX-Trigger', json_encode([
                'activityUpdated' => 'Activity updated successfully!'
            ]));
        }
        return redirect()->route('activities.index')->with('success', 'Activity updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {

        $this->authorize('delete', $activity);
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully.');
    }

    public function events()
    {
        $activities = Activity::all();

        $events = $activities->map(function ($activity) {
            return [
                'id' => $activity->activity_id,
                'title' => $activity->title,
                'start' => $activity->date_time,
                'classNames' => match($activity->status) {
                    'Planned' => 'dot-planned',
                    'Completed' => 'dot-completed',
                    'Cancelled' => 'dot-cancelled',
                    default => 'dot-default',
                },
            ];
        });

        return response()->json($events);
    }
}
