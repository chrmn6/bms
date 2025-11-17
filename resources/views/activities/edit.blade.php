<form hx-put="{{ route('activities.update', $activity->activity_id) }}" hx-target="#editActivityModalBody"
    hx-swap="none" hx-on::after-request="
        if (event.detail.xhr.status === 200) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('editActivityModal'));
            if (modal) { modal.hide(); }
            htmx.trigger(document.body, 'refreshTable');
        }">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <x-input-label class="block text-gray-900 dark:text-gray-300">Title</x-input-label>
        <input type="text" name="title" value="{{ old('title', $activity->title) }}" class="form-control" required>
    </div>
    <div class="mb-2">
        <x-input-label class="block text-gray-900 dark:text-gray-300">Description</x-input-label>
        <textarea name="description" class="form-control">{{ old('description', $activity->description) }}</textarea>
    </div>
    <div class="mb-2">
        <x-input-label class="block text-gray-900 dark:text-gray-300">Date & Time</x-input-label>
        <input type="datetime-local" name="date_time" class="form-control"
            value="{{ old('date_time', $activity->date_time->format('Y-m-d\TH:i')) }}" required>
    </div>
    <div class="mb-2">
        <x-input-label class="block text-gray-900 dark:text-gray-300">Location</x-input-label>
        <input type="text" name="location" value="{{ old('location', $activity->location) }}" class="form-control">
    </div>
    <div class="mb-2">
        <x-input-label class="block text-gray-900 dark:text-gray-300">Status</x-input-label>
        <select name="status" class="form-control">
            <option value="Planned" {{ old('status', $activity->status) === 'Planned' ? 'selected' : '' }}>
                Planned</option>
            <option value="Completed" {{ old('status', $activity->status) === 'Completed' ? 'selected' : '' }}>
                Completed</option>
            <option value="Cancelled" {{ old('status', $activity->status) === 'Cancelled' ? 'selected' : '' }}>Cancelled
            </option>
        </select>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            Update
        </x-primary-button>
    </div>
</form>