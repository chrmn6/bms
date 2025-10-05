<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 shadow rounded">
        <h1 class="text-2xl font-bold mb-4">Edit Announcement</h1>

        @can('update', $announcement)
            <form action="{{ route('staff.announcements.update', $announcement->announcement_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $announcement->title) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required>
                    @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Content</label>
                    <textarea name="content" id="content" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('content', $announcement->content) }}</textarea>
                    @error('content')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-black rounded hover:bg-green-700">
                        Update
                    </button>
                    <a href="{{ route('announcements.index') }}"
                        class="px-4 py-2 bg-gray-500 text-black rounded hover:bg-gray-600">
                        Cancel
                    </a>
                </div>
            </form>
        @else
            <p class="text-gray-600 dark:text-gray-300">You do not have permission to edit this announcement.</p>
        @endcan
    </div>
</x-app-layout>