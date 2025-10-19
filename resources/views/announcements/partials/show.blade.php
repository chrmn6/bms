<div>
    <h4 class="fw-bold mb-2">{{ $announcement->title }}</h4>
    <p class="mb-3">{{ $announcement->content }}</p>

    <small class="text-muted d-block mb-2">
        <i class="bi bi-clock"></i>
        Published {{ $announcement->created_at->diffForHumans() }}
        @if ($announcement->updated_at != $announcement->created_at)
            • Updated {{ $announcement->updated_at->diffForHumans() }}
        @endif
        • Posted by: <span class="fw-medium">{{ $announcement->user->first_name }}
            {{ $announcement->user->last_name }}</span>
    </small>

    <div class="d-flex justify-content-end gap-2">
        @can('update', $announcement)
            <a href="{{ route('staff.announcements.edit', $announcement) }}" class="btn btn-outline-warning btn-sm">
                <i class="bi bi-pencil"></i> Edit
            </a>
        @endcan

        @can('delete', $announcement)
            <form method="POST" action="{{ route('staff.announcements.destroy', $announcement) }}"
                onsubmit="return confirm('Are you sure you want to delete this announcement?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </form>
        @endcan
    </div>
</div>