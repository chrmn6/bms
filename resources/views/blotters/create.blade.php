<form hx-post="{{ route('blotters.store') }}" hx-swap="none" hx-encoding="multipart/form-data" hx-on::after-request="
        if (event.detail.xhr.status === 200) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('addBlotterModal'));
            modal.hide();
            htmx.trigger(document.body, 'refreshTable');
        }" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="block text-gray-700 dark:text-gray-300">Incident Type</label>
            <input type="text" name="incident_type"
                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="block text-gray-700 dark:text-gray-300">Date</label>
            <input type="date" name="incident_date"
                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="block text-gray-700 dark:text-gray-300">Time</label>
            <input type="time" name="incident_time"
                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="block text-gray-700 dark:text-gray-300">Location</label>
            <input type="text" name="location"
                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                required>
        </div>
    </div>
    <div class="mb-3">
        <label class="block text-gray-700 dark:text-gray-300">Description</label>
        <textarea name="description"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label class="block text-gray-700 dark:text-gray-300">Upload image</label>
        <input type="file" name="image" id="image"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
    </div>

    <div class="d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            File Report
        </x-primary-button>
    </div>
</form>