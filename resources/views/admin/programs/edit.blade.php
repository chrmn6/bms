@section('title', 'Programs')

<form hx-put="{{ route('admin.programs.update', $program->program_id) }}" hx-target="#editProgramModalBody"
    hx-swap="none" hx-on::after-request="
if (event.detail.xhr.status === 200) {
    const modal = bootstrap.Modal.getInstance(document.getElementById('editProgramModal'));
    if (modal) { modal.hide(); }
    htmx.trigger(document.body, 'refreshTable');
}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <x-input-label for="title" class="form-label">Program Title</x-input-label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $program->title) }}"
            required>
    </div>

    <div class="mb-3">
        <x-input-label for="description" class="form-label">Description</x-input-label>
        <textarea name="description" id="description" rows="2"
            class="form-control">{{ old('description', $program->description) }}</textarea>
    </div>

    <div class="mb-3">
        <x-input-label for="applicants_limit" class="form-label">Applicant Limit</x-input-label>
        <input type="number" name="applicants_limit" id="applicants_limit" class="form-control"
            value="{{ old('applicants_limit', $program->applicants_limit) }}" required>
    </div>

    <div class="mb-3">
        <x-input-label for="application_start" class="form-label">Applicant Start</x-input-label>
        <input type="date" name="application_start" id="application_start" class="form-control"
            value="{{ old('application_start', $program->application_start->format('Y-m-d')) }}" required>
    </div>

    <div class=" mb-3">
        <x-input-label for="application_end" class="form-label">Applicant End</x-input-label>
        <input type="date" name="application_end" id="application_end" class="form-control"
            value="{{ old('application_end', $program->application_end->format('Y-m-d')) }}" required>
    </div>

    <div class="mb-3">
        <x-input-label for="amount" class="form-label">Project Budget</x-input-label>
        <input type="number" name="amount" id="amount" step="0.01" min="0" class="form-control"
            value="{{ old('amount', $program->expense->amount) }}" required>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            Update
        </x-primary-button>
    </div>
</form>