<x-app-layout>
    <h1>Edit Activity</h1>

    <form action="{{ route('staff.activities.update', $activity->activity_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $activity->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $activity->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Date & Time</label>
            <input type="datetime-local" name="date_time"
                value="{{ \Carbon\Carbon::parse($activity->date_time)->format('Y-m-d\TH:i') }}" class="form-control"
                required>
        </div>
        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" value="{{ $activity->location }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="scheduled" {{ $activity->status === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                <option value="completed" {{ $activity->status === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="canceled" {{ $activity->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('staff.activities.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-app-layout>