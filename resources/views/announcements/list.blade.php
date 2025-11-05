<div class="row">
    @forelse($announcements as $announcement)
        <div class="col-lg-4 mb-4" id="announcement-{{ $announcement->id }}">
            <div class="card" hx-get="{{ route('announcements.show', $announcement) }}" hx-target="#announcementModalBody"
                hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal" data-bs-target="#announcementModal"
                style="cursor: pointer; overflow: hidden;">

                <div class="p-3">
                    <h3 class="fw-semibold mb-2" style="font-size: 1.5rem;">{{ $announcement->title }}</h3>
                    <div class="d-flex flex-column">
                        <small class="text-muted mb-1">
                            <i class="bi bi-person-fill me-1"></i>
                            By {{ $announcement->user->first_name }} {{ $announcement->user->last_name }}
                        </small>
                        <small class="text-muted mt-auto" style="font-size: 0.8rem;">
                            <i class="bi bi-clock me-1"></i>
                            {{ $announcement->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>

                <div class="card-body d-flex flex-column py-1 px-3">
                    <div class="d-flex gap-1 justify-content-end mb-2">
                        @can('update', $announcement)
                            <button hx-get="{{ route('announcements.edit', $announcement) }}" hx-target="#announcementModalBody"
                                hx-swap="innerHTML" data-bs-toggle="modal" data-bs-target="#announcementModal"
                                onclick="event.stopPropagation();"
                                class="!bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700 flex items-center justify-center p-1 text-white">
                                <i class="bi bi-pencil-square text-xs"></i>
                            </button>
                        @endcan

                        @can('delete', $announcement)
                            <form method="POST" hx-delete="{{ route('announcements.destroy', $announcement) }}"
                                hx-target="#announcement-{{ $announcement->id }}" hx-swap="innerHTML"
                                onsubmit="event.stopPropagation(); return confirm('Are you sure you want to delete this announcement?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="!bg-red-500 hover:!bg-red-600 active:!bg-red-700 flex items-center justify-center p-1 text-white">
                                    <i class="bi bi-trash text-xs"></i>
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>

            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card text-center py-5">
                <div class="card-body">
                    <i class="bi bi-megaphone-fill fa-3x text-muted mb-3"></i>
                    <h4>No Announcements Yet</h4>
                </div>
            </div>
        </div>
    @endforelse
</div>