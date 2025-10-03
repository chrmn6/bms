<x-app-layout>
    <h1>Edit Announcement</h1>

    <form action="{{ route('staff.announcements.update', $announcement->announcement_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $announcement->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control">{{ $announcement->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('staff.announcements.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-app-layout>