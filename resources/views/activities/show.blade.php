<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $activity->title }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-2xl font-bold mb-4">{{ $activity->title }}</h1>

                    <p><strong>Date & Time:</strong>
                        {{ \Carbon\Carbon::parse($activity->date_time)->format('F d, Y h:i A') }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($activity->status) }}</p>
                    <p><strong>Location:</strong> {{ $activity->location ?? 'N/A' }}</p>

                    <p class="mt-4"><strong>Description:</strong></p>
                    <p>{{ $activity->description ?? 'No description provided.' }}</p>

                    <a href="{{ route('activities.index') }}"
                        class="mt-6 inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Back
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>