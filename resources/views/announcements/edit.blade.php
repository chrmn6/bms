@can('update', $announcement)
    <form hx-put="{{ route('announcements.update', $announcement) }}" hx-target="#announcementModalBody" hx-swap="none"
        hx-on::after-request="
                                if (event.detail.xhr.status === 200) {
                                    const modal = bootstrap.Modal.getInstance(document.getElementById('announcementModal'));
                                    if (modal) { modal.hide(); }
                                    htmx.trigger(document.body, 'refreshTable');
                                }">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <x-input-label for="title" class="form-label">Title</x-input-label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $announcement->title) }}"
                required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" rows="4"
                class="form-control">{{ old('content', $announcement->content) }}</textarea>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
                Update
            </x-primary-button>
        </div>
    </form>
@else
    <p class="text-muted">You do not have permission to edit this announcement.</p>
@endcan