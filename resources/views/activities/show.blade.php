<div class="p-2">
    <h4 class="font-bold mb-2">{{ $activity->title }}</h4>
    <p class="mb-3">{!! nl2br(e($activity->description ?? 'No description provided.')) !!}</p>

    <div class="flex flex-col text-base gap-1">
        <!-- Status -->
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-gray-800 dark:text-white flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8v4l3 3M3.22302 14C4.13247 18.008 7.71683 21 12 21c4.9706 0 9-4.0294 9-9 0-4.97056-4.0294-9-9-9-3.72916 0-6.92858 2.26806-8.29409 5.5M7 9H3V5" />
            </svg>
            <div class="inline-flex items-center gap-1">
                <strong>Status:</strong> {{ ucfirst($activity->status) }}
            </div>
        </div>

        <!-- Location -->
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-gray-800 dark:text-white flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
            </svg>
            <div class="inline-flex items-center gap-1">
                <strong>Location:</strong> {{ $activity->location ?? 'N/A' }}
            </div>
        </div>

        <!-- Date & Time -->
        <div class="flex items-center gap-2 mb-2">
            <svg class="w-4 h-4 text-gray-800 dark:text-white flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
            </svg>
            <div class="inline-flex items-center gap-1">
                <strong>Date & Time:</strong> {{ $activity->date_time->format('F j, Y, g:i A') }}
            </div>
        </div>
    </div>


    <!-- Author -->
    <div class="flex items-center gap-1 text-base">
        <svg class="w-5 h-5 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
            <path
                d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
        <span class="font-semibold">By {{ $activity->user->full_name }}</span>
    </div>
</div>
</div>

<div class="flex gap-2 justify-end">
    <!-- Edit button -->
    @can('update', $activity)
        <x-primary-button hx-get="{{ route('activities.edit', $activity->activity_id) }}" hx-target="#editActivityModalBody"
            hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal" data-bs-target="#editActivityModal"
            class="!bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700 flex items-center justify-center h-7 w-7 p-0">
            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
            </svg>
        </x-primary-button>
    @endcan

    <!-- Delete button -->
    @can('delete', $activity)
        <form action="{{ route('activities.destroy', $activity->activity_id) }}" method="POST"
            onsubmit="return confirm('Delete this activity?')">
            @csrf
            @method('DELETE')
            <x-primary-button type="submit"
                class="!bg-red-500 hover:!bg-red-600 active:!bg-red-700 flex items-center justify-center h-7 w-7 p-0">
                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                </svg>
            </x-primary-button>
        </form>
    @endcan
</div>