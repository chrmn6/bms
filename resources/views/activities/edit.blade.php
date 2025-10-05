<x-app-layout>
    <h1>Edit Activity</h1>

    @if ($errors->any())
        <div class="mb-3 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Only show form if the user is staff --}}
    @if(auth()->user()->role === 'staff')
        <form action="{{ route('staff.activities.update', $activity->activity_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title', $activity->title) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description"
                    class="form-control">{{ old('description', $activity->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Date & Time</label>
                <input type="datetime-local" name="date_time"
                    value="{{ old('date_time', \Carbon\Carbon::parse($activity->date_time)->format('Y-m-d\TH:i')) }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Location</label>
                <input type="text" name="location" value="{{ old('location', $activity->location) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="scheduled" {{ old('status', $activity->status) === 'scheduled' ? 'selected' : '' }}>
                        Scheduled</option>
                    <option value="completed" {{ old('status', $activity->status) === 'completed' ? 'selected' : '' }}>
                        Completed</option>
                    <option value="canceled" {{ old('status', $activity->status) === 'canceled' ? 'selected' : '' }}>Canceled
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('staff.activities.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    @else
        <p class="text-red-600">You are not authorized to edit this activity.</p>
    @endif
</x-app-layout>