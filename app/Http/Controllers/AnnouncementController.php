<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:staff')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Announcement::class);
        $announcements = Announcement::with('user')->latest()->paginate(6);

        if ($request->header('HX-Request')) {
            return view('announcements.list', compact('announcements'));
        }

        return view('announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->authorize('create', Announcement::class);

        if ($request->header('HX-Request')) {
            return view('announcements.create');
        }

        return redirect()->route('announcements.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Announcement::class);

        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        Announcement::create($data);

        if ($request->header('HX-Request')) {
            $announcements = Announcement::with('user')->latest()->paginate(6);
            return response()->view('announcements.list', compact('announcements'))->header('HX-Trigger', json_encode([
                'announcementCreated' => 'Announcement created successfully!'
            ]));
        }

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement, Request $request)
    {
        $this->authorize('view', $announcement);

        if ($request->header('HX-Request')) {
            return view('announcements.show', compact('announcement'));
        }

        $announcements = Announcement::with('user')->latest()->paginate(6);
        return view('announcements.index', compact('announcements'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement, Request $request)
    {
        $this->authorize('update', $announcement);

        if ($request->header('HX-Request')) {
            return view('announcements.edit', compact('announcement')); // HTMX modal form
        }

        $announcements = Announcement::with('user')->latest()->paginate(6);
        return view('announcements.index', compact('announcements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $this->authorize('update', $announcement);

        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $announcement->update($data);

        if ($request->header('HX-Request')) {
            $announcements = Announcement::with('user')->latest()->paginate(6);
            return response()->view('announcements.list', compact('announcements'))->header('HX-Trigger', json_encode([
                'announcementCreated' => 'Announcement updated successfully!'
            ]));
        }

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement, Request $request)
    {
        $this->authorize('delete', $announcement);

        $announcement->delete();

        // HTMX response: return updated cards
        if ($request->header('HX-Request')) {
            $announcements = Announcement::with('user')->latest()->paginate(6);
            return view('announcements.list', compact('announcements'));
        }

        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}