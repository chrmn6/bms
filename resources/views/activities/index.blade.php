<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Activities') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Show create button only for staff --}}
                    @if(auth()->user()->role === 'staff')
                        <a href="{{ route('staff.activities.create') }}" class="btn btn-primary mb-3">Create New
                            Activity</a>
                    @endif

                    <table class="table-auto w-full border border-gray-300 dark:border-gray-600">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="px-4 py-2 border">Title</th>
                                <th class="px-4 py-2 border">Date & Time</th>
                                <th class="px-4 py-2 border">Status</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activities as $activity)
                                <tr class="border-b border-gray-200 dark:border-gray-600">
                                    <td class="px-4 py-2">{{ $activity->title }}</td>
                                    <td class="px-4 py-2">{{ $activity->date_time }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($activity->status) }}</td>
                                    <td class="px-4 py-2 flex gap-2">

                                        {{-- View button: visible to all --}}
                                        <a href="{{ route('activities.show', $activity->activity_id) }}"
                                            class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                                            View
                                        </a>

                                        {{-- Edit/Delete only for staff --}}
                                        @if(auth()->user()->role === 'staff')
                                            <a href="{{ route('staff.activities.edit', $activity->activity_id) }}"
                                                class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('staff.activities.destroy', $activity->activity_id) }}"
                                                method="POST" onsubmit="return confirm('Delete this activity?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>