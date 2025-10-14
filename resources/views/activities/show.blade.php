<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $activity->title }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-2xl font-bold mb-4">{{ $activity->title }}</h1>
                    <p><strong>Date & Time: </strong>
                        {{ $activity->date_time }}</p>
                    <p><strong>Status: </strong> {{ ucfirst($activity->status) }}</p>
                    <p><strong>Location: </strong> {{ $activity->location ?? 'N/A' }}</p>
                    <p><strong>Description: </strong>{{ $activity->description ?? 'No description provided.' }}</p>
                    <p class="mt-4"><strong>Posted by: </strong> {{ $activity->user->first_name }}</p>

                    <div class="mt-6 flex flex-wrap gap-2">
                        <!-- Back button -->
                        <x-primary-button type="button"
                            onclick="window.location.href='{{ route('activities.index') }}'">
                            Back
                        </x-primary-button>

                        <!-- Edit button -->
                        @can('update', $activity)
                            <x-primary-button type="button"
                                class="!bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700 rounded flex items-center justify-center"
                                onclick="window.location.href='{{ route('staff.activities.edit', $activity->activity_id) }}'">
                                Edit
                            </x-primary-button>
                        @endcan

                        <!-- Delete button -->
                        @can('delete', $activity)
                            <form action="{{ route('staff.activities.destroy', $activity->activity_id) }}" method="POST"
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>