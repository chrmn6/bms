<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Activity') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="mb-3 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @can('create', App\Models\Activity::class)
                        <form action="{{ route('staff.activities.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="block text-gray-900 dark:text-gray-300">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="block text-gray-900 dark:text-gray-300">Description</label>
                                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="block text-gray-900 dark:text-gray-300">Date & Time</label>
                                <input type="datetime-local" name="date_time" class="form-control"
                                    value="{{ old('date_time') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="block text-gray-900 dark:text-gray-300">Location</label>
                                <input type="text" name="location" class="form-control" value="{{ old('location') }}">
                            </div>
                            <div class="mb-3">
                                <label class="block text-gray-900 dark:text-gray-300">Status</label>
                                <select name="status" class="form-control">
                                    <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Scheduled
                                    </option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed
                                    </option>
                                    <option value="canceled" {{ old('status') == 'canceled' ? 'selected' : '' }}>Canceled
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                                Create
                            </button>
                            <a href="{{ route('staff.activities.index') }}"
                                class="inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                Back
                            </a>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>