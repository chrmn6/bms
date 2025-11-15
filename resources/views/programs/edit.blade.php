{{-- <form hx-put="{{ route('programs.update', $program) }}" hx-target="#programCard" hx-swap="innerHTML"
    hx-on::after-request="bootstrap.Modal.getInstance(document.getElementById('editProgramStatusModal')).hide()">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="status" class="form-label fw-semibold">Update Program Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="Planned" {{ $program->status == 'Planned' ? 'selected' : '' }}>Planned</option>
            <option value="Ongoing" {{ $program->status == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
            <option value="Completed" {{ $program->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            <option value="Cancelled" {{ $program->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" style="background-color: #6D0512; border-color: #6D0512;">
            Update Status
        </button>
    </div>
</form> --}}