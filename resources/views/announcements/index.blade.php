<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Announcements
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="p-6 text-gray-900 dark:text-gray-100">

            @can('create', App\Models\Announcement::class)
                <form action="{{ route('staff.announcements.create') }}" method="GET">
                    <x-primary-button class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700">
                        Create
                    </x-primary-button>
                </form>
            @endcan

            <div class=" mt-6 grid grid-cols-4 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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

                        <div class="flex items-center justify-between mt-4 px-1">
                            <p class="text-gray-700 dark:text-gray-300 text-sm">
                                Posted by: <span class="font-medium">{{ $announcement->user->first_name }}</span>
                            </p>

                            <div class="flex gap-1">
                                <x-primary-button type="button"
                                    class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700 rounded flex items-center justify-center"
                                    onclick="window.location.href='{{ route('announcements.show', $announcement->announcement_id) }}'">
                                    <ion-icon name="eye-outline" class="text-base"></ion-icon>
                                </x-primary-button>

                                @can('update', $announcement)
                                    <x-primary-button type="button"
                                        class="!bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700 rounded flex items-center justify-center"
                                        onclick="window.location.href='{{ route('staff.announcements.edit', $announcement->announcement_id) }}'">
                                        <ion-icon name="pencil-outline" class="text-base"></ion-icon>
                                    </x-primary-button>
                                @endcan

                                @can('delete', $announcement)
                                    <form action="{{ route('staff.announcements.destroy', $announcement->announcement_id) }}"
                                        method="POST" onsubmit="return confirm('Delete this announcement?')">
                                        @csrf
                                        @method('DELETE')

                                        <x-primary-button type="submit"
                                            class="!bg-red-500 hover:!bg-red-600 active:!bg-red-700 rounded flex items-center justify-center">
                                            <ion-icon name="trash-outline" class="text-base"></ion-icon>
                                        </x-primary-button>
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