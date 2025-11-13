<form hx-put="{{ route('clearances.update', $clearance->clearance_id) }}" hx-target="#editClearanceStatusModalBody"
    hx-swap="none" hx-on::after-request="
        if (event.detail.xhr.status === 200) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('editClearanceStatusModal'));
            if (modal) { modal.hide(); }
            htmx.trigger(document.body, 'refreshTable');
        }">
    @csrf
    @method('PUT')

    <div>
        <x-input-label for="status">Status</x-input-label>
        <select name="status" id="status"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md p-2">
            <option value="pending" {{ old('status', $clearance->status) === 'pending' ? 'selected' : '' }}>
                Pending</option>
            <option value="approved" {{ old('status', $clearance->status) === 'approved' ? 'selected' : '' }}>
                Approved</option>
            <option value="completed" {{ old('status', $clearance->status) === 'completed' ? 'selected' : '' }}>Completed
            </option>
            <option value="rejected" {{ old('status', $clearance->status) === 'rejected' ? 'selected' : '' }}>Rejected
            </option>
        </select>

        @error('status')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <x-input-label for="issued_date" class="form-label">Issued Date</x-input-label>
        <input type="date" name="issued_date" id="issued_date"
            value="{{ old('issued_date', optional($clearance->issued_date)->format('Y-m-d')) }}"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md p-2"
            required>

        @error('issued_date')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <x-input-label for="valid_until" class="form-label">Valid Until</x-input-label>
        <input type="date" name="valid_until" id="valid_until"
            value="{{ old('valid_until', optional($clearance->valid_until)->format('Y-m-d')) }}"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md p-2"
            required>

        @error('valid_until')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <x-input-label for="remarks">Remarks</x-input-label>
        <textarea name="remarks" id="remarks" rows="3" required
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md p-2"
            placeholder="Enter any notes here.">{{ old('remarks', $clearance->remarks) }}</textarea>

        @error('remarks')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            Update
        </x-primary-button>
    </div>
</form>