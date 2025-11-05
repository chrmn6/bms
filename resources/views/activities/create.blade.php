<form hx-post="{{ route('activities.store') }}" hx-swap="none" hx-on::after-request="
    if (event.detail.xhr.status === 200) {
        const modal = bootstrap.Modal.getInstance(document.getElementById('ActivityModal'));
        modal.hide();
        htmx.trigger(document.body, 'refreshTable');
    }">
    @csrf
    <div class="mb-3">
        <label class="block text-gray-900 dark:text-gray-300">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
    </div>
    <div class="mb-3">
        <label class="block text-gray-900 dark:text-gray-300">Description</label>
        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
    </div>
    <div class="mb-3">
        <label class="block text-gray-900 dark:text-gray-300">Date & Time</label>
        <input type="datetime-local" name="date_time" class="form-control" value="{{ old('date_time') }}" required>
    </div>
    <div class="mb-3">
        <label class="block text-gray-900 dark:text-gray-300">Location</label>
        <input type="text" name="location" class="form-control" value="{{ old('location') }}">
    </div>
    <div class="mb-3">
        <label class="block text-gray-900 dark:text-gray-300">Status</label>
        <select name="status" class="form-control">
            <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Scheduled
            </option>
            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed
            </option>
            <option value="canceled" {{ old('status') == 'canceled' ? 'selected' : '' }}>Canceled
            </option>
        </select>
    </div>

    <div class="mt-3 d-flex justify-content-end gap-2">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Create Activity</button>
    </div>
</form>