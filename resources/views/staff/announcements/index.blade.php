<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Announcement') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('staff.announcements.create') }}" class="btn btn-primary">Create New
                        Announcement</a>

                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($announcements as $announcement)
                                <tr>
                                    <td>{{ $announcement->title }}</td>
                                    <td>{{ $announcement->content }}</td>
                                    <td>
                                        <a href="{{ route('staff.announcements.edit', $announcement->announcement_id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>

                                        <form
                                            action="{{ route('staff.announcements.destroy', $announcement->announcement_id) }}"
                                            method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Delete this activity?')">Delete</button>
                                        </form>
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