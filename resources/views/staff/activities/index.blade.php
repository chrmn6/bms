<x-app-layout>
    <h1>Activities</h1>

    <a href="{{ route('staff.activities.create') }}" class="btn btn-primary">Create New Activity</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date & Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->title }}</td>
                    <td>{{ $activity->date_time }}</td>
                    <td>{{ ucfirst($activity->status) }}</td>
                    <td>
                        <a href="{{ route('staff.activities.edit', $activity->activity_id) }}"
                            class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('staff.activities.destroy', $activity->activity_id) }}" method="POST"
                            style="display:inline">
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