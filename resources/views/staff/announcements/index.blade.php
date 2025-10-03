<x-app-layout>
    <h1>Announcement</h1>

    <a href="{{ route('staff.announcements.create') }}" class="btn btn-primary">Create New Announcement</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($announcements as $announcement)
                <tr>
                    <td>{{ $announcement->title }}</td>
                    <td>{{ $announcement->content }}</td>
                    <td>
                        <a href="{{ route('staff.announcements.edit', $announcement->announcement_id) }}"
                            class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('staff.announcements.destroy', $announcement->announcement_id) }}"
                            method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this activity?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>