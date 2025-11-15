<form hx-post="{{ route('programs.store') }}" hx-swap="none" hx-on::after-request="
        if (event.detail.xhr.status === 200) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('addProgramModal'));
            modal.hide();
            htmx.trigger(document.body, 'refreshTable');
        }">
    @csrf

    <div class="mb-2">
        <x-input-label for="title" :value="__('Program title')" />
        <input type="text" name="title"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            required>
    </div>

    <div class="mb-2">
        <x-input-label for="description" :value="__('Description')" />
        <textarea name="description"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            rows="3" required></textarea>
    </div>

    <div class="mb-2">
        <x-input-label for="program_date" :value="__('Program Date')" />
        <input type="date" name="program_date"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            required>
    </div>

    <div class="mb-2">
        <x-input-label for="time" :value="__('Program Time')" />
        <input type="time" name="time"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            required>
    </div>

    <div class="mb-2">
        <x-input-label for="location" :value="__('Location')" />
        <input type="text" name="location"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            required>
    </div>

    <div class="mb-3">
        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" id="status"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#6D0512] focus:ring focus:ring-[#6D0512]/50">
            <option value="Planned">Planned</option>
            <option value="Ongoing">Ongoing</option>
            <option value="Completed">Completed</option>
        </select>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            Create
        </x-primary-button>
    </div>
</form>