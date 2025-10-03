<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'role:staff']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Auth::user()->announcements()->latest()->get();
        return view('staff.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        Announcement::create($data);

        return redirect()->route('staff.announcements.index')->with('success', 'Announcement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcements)
    {
        return view('staff.announcements.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        if ($announcement->user_id !== Auth::id()) abort(403);
        return view('staff.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        if ($announcement->user_id !== Auth::id()) abort(403);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $announcement->update($data);

        return redirect()->route('staff.announcements.index')->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('staff.announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}
