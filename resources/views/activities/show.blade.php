<h1 class="text-2xl font-bold mb-4">{{ $activity->title }}</h1>
<p><strong>Date & Time: </strong>
    {{ $activity->date_time }}</p>
<p><strong>Status: </strong> {{ ucfirst($activity->status) }}</p>
<p><strong>Location: </strong> {{ $activity->location ?? 'N/A' }}</p>
<p><strong>Description: </strong>{{ $activity->description ?? 'No description provided.' }}</p>
<p class="mt-4"><strong>Posted by: </strong> {{ $activity->user->full_name }}</p>

<div class="mt-6 flex flex-wrap gap-2">
    <!-- Edit button -->
    @can('update', $activity)
        <x-primary-button hx-get="{{ route('activities.edit', $activity->activity_id) }}" hx-target="#editActivityModalBody"
            hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal" data-bs-target="#editActivityModal"
            class="!bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700 flex items-center justify-center">
            <i class="bi bi-pencil text-xs"></i>
        </x-primary-button>
    @endcan

    <!-- Delete button -->
    @can('delete', $activity)
        <form action="{{ route('activities.destroy', $activity->activity_id) }}" method="POST"
            onsubmit="return confirm('Delete this activity?')">
            @csrf
            @method('DELETE')
            <x-primary-button type="submit"
                class="!bg-red-500 hover:!bg-red-600 active:!bg-red-700 rounded flex items-center justify-center">
                Delete
            </x-primary-button>
        </form>
    @endcan
</div>