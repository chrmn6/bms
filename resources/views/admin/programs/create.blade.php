<form hx-post="{{ route('admin.programs.store') }}" hx-swap="none" hx-on:after-request="
        const modalEl = document.getElementById('addProgramModal');
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.hide();  // hide the modal
        htmx.trigger(document.body, 'refreshTable');
    ">
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
            rows="2" required></textarea>
    </div>

    <div class="mb-2">
        <x-input-label for="applicant_limit" :value="__('Applicant Limit')" />
        <input type="number" name="applicants_limit"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            required>
    </div>

    <div class="mb-2">
        <x-input-label for="application_start" :value="__('Application Start')" />
        <input type="date" name="application_start"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            required>
    </div>

    <div class="mb-2">
        <x-input-label for="application_end" :value="__('Application End')" />
        <input type="date" name="application_end"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            required>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            Create
        </x-primary-button>
    </div>
</form>