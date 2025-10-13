<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $blotter->incident_type }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-2xl font-bold mb-4">{{ $blotter->incident_type }}</h1>
                    <p><strong>Date: </strong>{{ $blotter->incident_date }}</p>
                    <p><strong>Time: </strong>{{ $blotter->incident_time }}</p>
                    <p><strong>Description: </strong>{{ $blotter->description }}</p>
                    <p><strong>Location: </strong> {{ $blotter->location ?? 'N/A' }}</p>
                    <p><strong>Status: </strong> {{ ucfirst($blotter->status) }}</p>
                    <p><strong>Complainant: </strong> {{ $blotter->resident->full_name }}</p>
                    <p><strong>Mediated by: </strong> {{ $blotter->user?->first_name ?? 'N/A' }}</p>

                    <a href="{{ route('blotters.index') }}"
                        class="mt-6 inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>