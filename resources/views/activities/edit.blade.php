<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Activity') }}
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
                    @can('update', $activity)
                        <form action="{{ route('staff.activities.update', $activity->activity_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="block text-gray-900 dark:text-gray-300">Title</label>
                                <input type="text" name="title" value="{{ old('title', $activity->title) }}"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="block text-gray-900 dark:text-gray-300">Description</label>
                                <textarea name="description"
                                    class="form-control">{{ old('description', $activity->description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="block text-gray-900 dark:text-gray-300">Date & Time</label>
                                <input type="datetime-local" name="date_time"
                                    value="{{ old('date_time', \Carbon\Carbon::parse($activity->date_time)->format('Y-m-d\TH:i')) }}"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="block text-gray-900 dark:text-gray-300">Location</label>
                                <input type="text" name="location" value="{{ old('location', $activity->location) }}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="block text-gray-900 dark:text-gray-300">Status</label>
                                <select name="status" class="form-control">
                                    <option value="scheduled" {{ old('status', $activity->status) === 'scheduled' ? 'selected' : '' }}>
                                        Scheduled</option>
                                    <option value="completed" {{ old('status', $activity->status) === 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                    <option value="canceled" {{ old('status', $activity->status) === 'canceled' ? 'selected' : '' }}>Canceled
                                    </option>
                                </select>
                            </div>

                            <div class="flex items-center gap-2">
                                <x-primary-button type="submit"
                                    class="!bg-green-500 hover:!bg-green-600 active:!bg-green-700">
                                    Update
                                </x-primary-button>
                                <x-primary-button type="button"
                                    onclick="window.location.href='{{ route('staff.activities.index') }}'">
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