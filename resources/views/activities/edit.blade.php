<form hx-put="{{ route('staff.activities.update', $activity->activity_id) }}" hx-target="#editActivityModalBody"
    hx-swap="none" hx-on::after-request="
        if (event.detail.xhr.status === 200) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('editActivityModal'));
            if (modal) { modal.hide(); }
            htmx.trigger(document.body, 'refreshTable');
        }">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="block text-gray-900 dark:text-gray-300">Title</label>
        <input type="text" name="title" value="{{ old('title', $activity->title) }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="block text-gray-900 dark:text-gray-300">Description</label>
        <textarea name="description" class="form-control">{{ old('description', $activity->description) }}</textarea>
    </div>
    <div class="mb-3">
        <label class="block text-gray-900 dark:text-gray-300">Date & Time</label>
        <input type="datetime-local" name="date_time"
            value="{{ old('date_time', \Carbon\Carbon::parse($activity->date_time)->format('Y-m-d\TH:i')) }}"
            class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="block text-gray-900 dark:text-gray-300">Location</label>
        <input type="text" name="location" value="{{ old('location', $activity->location) }}" class="form-control">
    </div>
    <div class="mb-3">
        <label class="block text-gray-900 dark:text-gray-300">Status</label>
        <select name="status" class="form-control">
            <option value="scheduled" {{ old('status', $activity->status) === 'scheduled' ? 'selected' : '' }}>
                Scheduled</option>
            <option value="completed" {{ old('status', $activity->status) === 'completed' ? 'selected' : '' }}>
                Completed</option>
            <option value="canceled" {{ old('status', $activity->status) === 'canceled' ? 'selected' : '' }}>Canceled
            </option>
        </select>
    </div>

    <x-primary-button type="submit" class="!bg-green-500 hover:!bg-green-600 active:!bg-green-700">
        Update
    </x-primary-button>
</form>