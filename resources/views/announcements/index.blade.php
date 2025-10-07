<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Announcements
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="p-6 text-gray-900 dark:text-gray-100">

            @can('create', App\Models\Announcement::class)
                <a href="{{ route('staff.announcements.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Create
                </a>
            @endcan

            <div class="mt-6 grid grid-cols-4 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($announcements as $announcement)
                    <div
                        class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 shadow-md p-5 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl bold font-semibold text-gray-900 dark:text-white mb-2">
                                {{ $announcement->title }}
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mb-4">
                                {{ $announcement->content }}
                            </p>
                        </div>

                        <div class="flex gap-2 items-center justify-between mt-4">
                            <p class="text-gray-700 dark:text-gray-300 text-xs">
                                Posted by: {{ $announcement->user->first_name }}
                            </p>

                            <div class="flex gap-2">
                                <a href="{{ route('announcements.show', $announcement->announcement_id) }}"
                                    class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm flex items-center justify-center">
                                    <ion-icon name="eye-outline" class="text-base"></ion-icon>
                                </a>

                                @can('update', $announcement)
                                    <a href="{{ route('staff.announcements.edit', $announcement->announcement_id) }}"
                                        class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm flex items-center justify-center">
                                        <ion-icon name="pencil-outline" class="text-base"></ion-icon>
                                    </a>
                                @endcan

                                @can('delete', $announcement)
                                    <form action="{{ route('staff.announcements.destroy', $announcement->announcement_id) }}"
                                        method="POST" onsubmit="return confirm('Delete this announcement?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm flex items-center justify-center">
                                            <ion-icon name="trash-outline" class="text-base"></ion-icon>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $announcements->links() }}
            </div>
        </div>
    </div>
</x-app-layout>