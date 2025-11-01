<form hx-put="{{ route('blotters.update', $blotter->blotter_id) }}" hx-target="#editStatusModalBody" hx-swap="none"
    hx-on::after-request="
        if (event.detail.xhr.status === 200) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('editStatusModal'));
            if (modal) { modal.hide(); }
            htmx.trigger(document.body, 'refreshTable');
        }">
    @csrf
    @method('PUT')

    <div>
        <label for="status">Status</label>
        <select name="status" id="status" class="w-full border rounded p-2">
            <option value="pending" {{ old('status', $blotter->status) === 'pending' ? 'selected' : '' }}>
                Pending</option>
            <option value="investigating" {{ old('status', $blotter->status) === 'investigating' ? 'selected' : '' }}>
                Investigating</option>
            <option value="resolved" {{ old('status', $blotter->status) === 'resolved' ? 'selected' : '' }}>Resolved
            </option>
            <option value="dismissed" {{ old('status', $blotter->status) === 'dismissed' ? 'selected' : '' }}>Dismissed
            </option>
        </select>
    </div>
    <x-primary-button type="submit" class="mt-4 !bg-green-500 hover:!bg-green-600 active:!bg-green-700">
        Update
    </x-primary-button>
</form>