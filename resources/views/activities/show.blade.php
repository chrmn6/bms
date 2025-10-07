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
                        <a href="{{ route('activities.index') }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Back
                        </a>

                        <!-- Edit button -->
                        @can('update', $activity)
                            <a href="{{ route('staff.activities.edit', $activity->activity_id) }}"
                                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 flex items-center gap-1">Edit
                            </a>
                        @endcan

                        <!-- Delete button -->
                        @can('delete', $activity)
                            <form action="{{ route('staff.activities.destroy', $activity->activity_id) }}" method="POST"
                                onsubmit="return confirm('Delete this activity?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 flex items-center gap-1">Delete
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>