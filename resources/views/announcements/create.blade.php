<form hx-post="{{ route('announcements.store') }}" hx-target="#announcementModalBody" hx-swap="none"
    hx-on::after-request="
        if (event.detail.xhr.status === 200) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('announcementModal'));
            if (modal) { modal.hide(); }
            htmx.trigger(document.body, 'refreshTable');
        }">
    @csrf

    <div class="mb-3">
        <x-input-label for="title" class="form-label">Title</x-input-label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <x-input-label for="content" class="form-label">Content</x-input-label>
        <textarea name="content" id="content" rows="4" class="form-control"></textarea>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            Post
        </x-primary-button>
    </div>
</form>