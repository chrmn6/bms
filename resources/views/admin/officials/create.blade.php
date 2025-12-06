<form hx-post="{{ route('admin.officials.store') }}" enctype="multipart/form-data" hx-target="#officialModalBody"
    hx-swap="none" hx-on::after-request="
        if (event.detail.xhr.status === 200) { 
            const modal = bootstrap.Modal.getInstance(document.getElementById('officialModal')); 
            if (modal) { modal.hide(); } 
            htmx.trigger(document.body, 'refreshTable');
        }
    ">
    @csrf

    <div class="row g-3 mb-2">
        <div class="col-md-6">
            <x-input-label for="resident_id" :value="__('Official Name')" />
            <select id="resident_id" name="resident_id" required
                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                <option value="">Select Resident</option>
                @foreach($residents as $resident)
                    <option value="{{ $resident->resident_id }}">{{ $resident->full_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <x-input-label for="position" :value="__('Position')" />
            <select id="position" name="position" required
                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                <option value="">Select Position</option>
                <option value="Barangay Captain">Barangay Captain</option>
                <option value="SK Kagawad">SK Kagawad</option>
                <option value="Barangay Council">Barangay Council</option>
            </select>
        </div>
    </div>

    <div class="row g-3 mb-2">
        <div class="col-md-6">
            <x-input-label for="term_start" :value="__('Term Start')" />
            <x-text-input id="term_start" name="term_start" type="date" class="mt-1 block w-full" required />
        </div>
        <div class="col-md-6">
            <x-input-label for="term_end" :value="__('Term End')" />
            <x-text-input id="term_end" name="term_end" type="date" class="mt-1 block w-full" />
        </div>
    </div>

    <div class="row g-3 mb-2">
        <div class="col-md-6">
            <x-input-label for="status" :value="__('Status')" />
            <select id="status" name="status" required
                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                <option value="">Select Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            Create
        </x-primary-button>
    </div>
</form>