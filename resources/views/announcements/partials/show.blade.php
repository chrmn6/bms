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
</div>