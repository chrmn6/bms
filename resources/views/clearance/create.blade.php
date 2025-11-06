<form hx-post="{{ route('clearances.store') }}" hx-swap="none" hx-on::after-request="
    if (event.detail.xhr.status === 200) {
        const modal = bootstrap.Modal.getInstance(document.getElementById('addClearanceModal'));
        modal.hide();
        htmx.trigger(document.body, 'refreshTable');
    }">
    @csrf
    <div class="mb-4">
        <label for="clearance_type" class="block text-gray-700 dark:text-gray-300 font-medium">Clearance
            Type</label>
        <select id="clearance_type" name="clearance_type" required
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
            <option value="">Select type</option>
            <option value="Barangay Clearance">Barangay Clearance</option>
            <option value="Business Clearance">Business Clearance</option>
            <option value="Residency Clearance">Residency Clearance</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="purpose" class="block text-gray-700 dark:text-gray-300 font-medium">Purpose</label>
        <textarea id="purpose" name="purpose" rows="3" required
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            placeholder="Explain why you need this clearance"></textarea>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            Submit
        </x-primary-button>
    </div>
</form>