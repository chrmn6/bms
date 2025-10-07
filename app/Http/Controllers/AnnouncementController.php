<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
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

        $this->authorize('viewAny', Announcement::class);
        $announcements = Announcement::with('user')->latest()->paginate(6);
        return view('announcements.index', compact('announcements'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Announcement::class);
        return view('announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Announcement::class);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        Announcement::create($data);

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        $this->authorize('view', $announcement);
        return view('announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        $this->authorize('update', $announcement);
        return view('announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $this->authorize('update', $announcement);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $announcement->update($data);

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $this->authorize('delete', $announcement);
        $announcement->delete();
        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}
