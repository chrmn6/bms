<x-app-layout>
    <h1>Create Announcement</h1>

    <form action="{{ route('staff.announcements.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('staff.announcements.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-app-layout>