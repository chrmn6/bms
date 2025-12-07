<form hx-post="{{ route('activities.store') }}" hx-target="#activityModalBody" hx-swap="none" hx-on::after-request="
    if (event.detail.xhr.status === 200) {
        const modal = bootstrap.Modal.getInstance(document.getElementById('addActivityModal'));
        modal.hide();
        htmx.trigger(document.body, 'refreshTable');
    }">
    @csrf
    <div class="mb-2">
        <x-input-label class="block text-gray-900 dark:text-gray-300">Title</x-input-label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="FUN RUN 2025"
            required>
    </div>
    <div class="mb-2">
        <x-input-label class="block text-gray-900 dark:text-gray-300">Description</x-input-label>
        <textarea name="description" class="form-control" rows="2"
            placeholder="This coming 2025 .... ">{{ old('description') }}</textarea>
    </div>
    <div class="mb-2">
        <x-input-label class="block text-gray-900 dark:text-gray-300">Date & Time</x-input-label>
        <input type="datetime-local" name="date_time" class="form-control"
            value="{{ old('date_time', isset($date) ? $date . 'T00:00' : '') }}" required>
    </div>
    <div class="mb-2">
        <x-input-label class="block text-gray-900 dark:text-gray-300">Location</x-input-label>
        <input type="text" name="location" class="form-control" placeholder="Coastal Road" value="{{ old('location') }}"
            required>
    </div>
    <div class="mb-2">
        <x-input-label class="block text-gray-900 dark:text-gray-300">Status</x-input-label>
        <select name="status" class="form-control">
            <option value="Planned" {{ old('status') == 'Planned' ? 'selected' : '' }}>Planned
            </option>
            <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed
            </option>
            <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled
            </option>
        </select>
    </div>

    <div class="mt-3 d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            Create
        </x-primary-button>
    </div>
</form>