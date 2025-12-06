<form hx-put="{{ route('admin.officials.update', $official->official_id) }}" hx-target="#editOfficialModalBody"
    hx-swap="none" hx-on::after-request="
        if (event.detail.xhr.status === 200) { 
            const modal = bootstrap.Modal.getInstance(document.getElementById('editOfficialModal')); 
            if (modal) { modal.hide(); } 
            htmx.trigger(document.body, 'refreshTable');
        }
    ">
    @csrf
    @method('PUT')

    <div class="row g-3 mb-2">
        <div class="col-md-6">
            <x-input-label for="resident_id" :value="__('Official Name')" />
            <x-text-input id="resident_id" name="resident_id" type="text"
                value="{{ old('resident_id', $official->resident->full_name) }}"
                class="mt-1 block w-full bg-gray-100 cursor-not-allowed" readonly />
        </div>
        <div class="col-md-6">
            <x-input-label for="position" :value="__('Position')" />
            <x-text-input id="position" name="position" type="text" value="{{ old('position', $official->position) }}"
                class="mt-1 block w-full bg-gray-100 cursor-not-allowed" readonly />
        </div>
    </div>

    <div class="row g-3 mb-2">
        <div class="col-md-6">
            <x-input-label for="term_start" :value="__('Term Start')" />
            <x-text-input id="term_start" name="term_start" type="date"
                value="{{ old('term_start', $official->term_start?->format('Y-m-d')) }}" class="mt-1 block w-full"
                readonly />
        </div>
        <div class="col-md-6">
            <x-input-label for="term_end" :value="__('Term End')" />
            <x-text-input id="term_end" name="term_end" type="date"
                value="{{ old('term_end', $official->term_end?->format('Y-m-d')) }}" class="mt-1 block w-full" />
        </div>
    </div>

    <div class="row g-3 mb-2">
        <div class="col-md-6">
            <x-input-label for="status" :value="__('Status')" />
            <select id="status" name="status"
                class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#6D0512] focus:border-[#6D0512]">
                <option value="Active" {{ old('status', $official->status) === 'Active' ? 'selected' : '' }}>Active
                </option>
                <option value="Inactive" {{ old('status', $official->status) === 'Inactive' ? 'selected' : '' }}>Inactive
                </option>
            </select>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            Update
        </x-primary-button>
    </div>
</form>