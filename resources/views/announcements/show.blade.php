<div class="p-2">
    <h4 class="fw-bold mb-2">{{ $announcement->title }}</h4>
    <p class="mb-3">{!! nl2br(e($announcement->content)) !!}</p>

    <div class="flex flex-col gap-1 text-gray-500 text-sm">
        <!-- Published / Updated -->
        <div class="flex items-center gap-1">
            <svg class="w-4 h-4 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8v4l3 3M3.22302 14C4.13247 18.008 7.71683 21 12 21c4.9706 0 9-4.0294 9-9 0-4.97056-4.0294-9-9-9-3.72916 0-6.92858 2.26806-8.29409 5.5M7 9H3V5" />
            </svg>
            <span>
                Published {{ $announcement->created_at->diffForHumans() }}
                @if ($announcement->updated_at != $announcement->created_at)
                    · Updated {{ $announcement->updated_at->diffForHumans() }}
                @endif
            </span>
        </div>

        <!-- Author -->
        <div class="flex items-center gap-1">
            <svg class="w-5 h-5 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                <path
                    d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <span class="font-medium">By {{ $announcement->user->full_name }}</span>
        </div>
    </div>
</div>