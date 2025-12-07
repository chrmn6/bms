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
            placeholder="GREENHOUSE PROGRAM" required>
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div class="mb-2">
        <x-input-label for="description" :value="__('Description')" />
        <textarea name="description"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            rows="2" placeholder="This program is for .... " required></textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="mb-2">
        <x-input-label for="applicant_limit" :value="__('Applicant Limit')" />
        <input type="number" name="applicants_limit"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            placeholder="100" required>
        <x-input-error :messages="$errors->get('applicant_limit')" class="mt-2" />
    </div>

    <div class="mb-2">
        <x-input-label for="application_start" :value="__('Application Start')" />
        <input type="date" name="application_start"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            required>
        <x-input-error :messages="$errors->get('application_start')" class="mt-2" />
    </div>

    <div class="mb-2">
        <x-input-label for="application_end" :value="__('Application End')" />
        <input type="date" name="application_end"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            required>
        <x-input-error :messages="$errors->get('application_end')" class="mt-2" />
    </div>

    <div class="mb-2">
        <x-input-label for="amount" :value="__('Project Budget')" />
        <input type="number" name="amount" step="0.01" min="0"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            placeholder="10000" required>
        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
    </div>

    <div class="mb-2">
        <x-input-label for="created_by" :value="__('Program Organizer')" />
        <select name="created_by" id="created_by" class="w-full border-gray-300 rounded-md shadow-sm" required>
            <option value="">Select Official</option>
            @foreach($officials as $official)
                <option value="{{ $official->official_id }}">
                    {{ $official->resident->full_name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('created_by')" class="mt-2" />
    </div>

    <div class="d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            Create
        </x-primary-button>
    </div>
</form>