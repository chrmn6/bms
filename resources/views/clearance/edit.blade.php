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
        <label for="status">Status</label>
        <select name="status" id="status"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md p-2">
            <option value="pending" {{ old('status', $clearance->status) === 'pending' ? 'selected' : '' }}>
                Pending</option>
            <option value="approved" {{ old('status', $clearance->status) === 'approved' ? 'selected' : '' }}>
                Approved</option>
            <option value="released" {{ old('status', $clearance->status) === 'clearance' ? 'selected' : '' }}>Released
            </option>
            <option value="rejected" {{ old('status', $clearance->status) === 'rejected' ? 'selected' : '' }}>Rejected
            </option>
        </select>

        @error('status')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="issued_date" class="form-label">Issued Date</label>
        <input type="date" name="issued_date" id="issued_date"
            value="{{ old('issued_date', optional($clearance->issued_date)->format('Y-m-d')) }}"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md p-2"
            required>

        @error('issued_date')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="valid_until" class="form-label">Valid Until</label>
        <input type="date" name="valid_until" id="valid_until"
            value="{{ old('valid_until', optional($clearance->valid_until)->format('Y-m-d')) }}"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md p-2"
            required>

        @error('valid_until')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="remarks">Remarks</label>
        <textarea name="remarks" id="remarks" rows="3" required
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md p-2"
            placeholder="Enter any notes here.">{{ old('remarks', $clearance->remarks) }}</textarea>

        @error('remarks')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <x-primary-button type="submit" class="!bg-green-500 hover:!bg-green-600 active:!bg-green-700">
        Update
    </x-primary-button>
</form>