<div class="p-2">
    <h4 class="fw-bold mb-2">{{ $announcement->title }}</h4>
    <p class="mb-3">{{ $announcement->content }}</p>

    <!-- Metadata with icons -->
    <small class="text-muted d-block mb-2">
        <i class="bi bi-clock me-1"></i>
        Published {{ $announcement->created_at->diffForHumans() }}
        @if ($announcement->updated_at != $announcement->created_at)
            · Updated {{ $announcement->updated_at->diffForHumans() }}
        @endif
    </small>

    <small class="text-muted">
        <i class="bi bi-person-fill me-1"></i>
        By <span class="fw-medium">{{ $announcement->user->full_name }}</span>
    </small>
</div>