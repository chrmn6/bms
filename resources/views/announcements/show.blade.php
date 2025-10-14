<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $announcement->title }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-2xl font-bold mb-4">{{ $announcement->title }}</h1>
                    <p>{{ $announcement->content}}</p>

                    <div class="mt-4 flex gap-2">
                        @can('update', $announcement)
                            <x-primary-button type="button"
                                class="!bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700 rounded flex items-center justify-center"
                                onclick="window.location.href='{{ route('staff.announcements.edit', $announcement->announcement_id) }}'">
                                Edit
                            </x-primary-button>
                        @endcan

                        @can('delete', $announcement)
                            <form action="{{ route('staff.announcements.destroy', $announcement->announcement_id) }}"
                                method="POST" onsubmit="return confirm('Delete this announcement?')">
                                @csrf
                                @method('DELETE')
                                <x-primary-button type="submit"
                                    class="!bg-red-500 hover:!bg-red-600 active:!bg-red-700 rounded flex items-center justify-center">
                                    Delete
                                </x-primary-button>
                            </form>
                        @endcan

                        <x-primary-button type="button"
                            onclick="window.location.href='{{ route('announcements.index') }}'">
                            Back
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>