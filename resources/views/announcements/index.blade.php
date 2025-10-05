<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Announcements') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Show create button only if user can create --}}
                    @can('create', App\Models\Announcement::class)
                        <a href="{{ route('staff.announcements.create') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Create New Announcement
                        </a>
                    @endcan

                    <table class="table-auto mt-3 w-full border border-gray-300 dark:border-gray-600">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="px-4 py-2 border">Title</th>
                                <th class="px-4 py-2 border">Content</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($announcements as $announcement)
                                <tr class="border-b border-gray-200 dark:border-gray-600">
                                    <td class="px-4 py-2">{{ $announcement->title }}</td>
                                    <td class="px-4 py-2">{{ Str::limit($announcement->content, 50) }}</td>
                                    <td class="px-4 py-2 flex gap-2 items-center">

                                        {{-- View button: visible to all --}}
                                        <a href="{{ route('announcements.show', $announcement->announcement_id) }}"
                                            class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                                            View
                                        </a>

                                        {{-- Show edit button only if user can update --}}
                                        @can('update', $announcement)
                                            <a href="{{ route('staff.announcements.edit', $announcement->announcement_id) }}"
                                                class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                                Edit
                                            </a>
                                        @endcan

                                        {{-- Show delete button only if user can delete --}}
                                        @can('delete', $announcement)
                                            <form
                                                action="{{ route('staff.announcements.destroy', $announcement->announcement_id) }}"
                                                method="POST" onsubmit="return confirm('Delete this announcement?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan

                                        {{-- If user is not staff and cannot update/delete, show '-' --}}
                                        @cannot('update', $announcement)
                                        @cannot('delete', $announcement)
                                        <span class="text-gray-500">-</span>
                                        @endcannot
                                        @endcannot

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