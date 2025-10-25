@section('title') {{ 'Blotter Report' }} @endsection

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

                    <x-primary-button type="button" class="mt-6"
                        onclick="window.location.href='{{ route('blotters.index') }}'">
                        Back
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>