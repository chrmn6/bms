<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Announcement') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @can('create', App\Models\Announcement::class)
                        <form action="{{ route('staff.announcements.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="title"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-200">Title</label>
                                <input type="text" name="title" id="title"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    value="{{ old('title') }}" required>
                                @error('title')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="content"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-200">Content</label>
                                <textarea name="content" id="content" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('content') }}</textarea>
                                @error('content')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex items-center gap-2">
                                <x-primary-button type="submit" class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700">
                                    Create
                                </x-primary-button>
                                <x-primary-button type="button"
                                    onclick="window.location.href='{{ route('announcements.index') }}'">
                                    Back
                                </x-primary-button>
                            </div>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>