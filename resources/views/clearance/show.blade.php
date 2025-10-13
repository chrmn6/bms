<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $clearance->clearance_type }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-2xl font-bold mb-4">{{ $clearance->clearance_type }}</h1>
                    <p><strong>Purpose: </strong>{{ $clearance->purpose }}</p>
                    <p><strong>Issued Date: </strong>{{ $clearance->issued_date ?? '-' }}</p>
                    <p><strong>Valid Until: </strong>{{ $clearance->valid_until ?? '-' }}</p>
                    <p><strong>Status: </strong> {{ ucfirst($clearance->status) }}</p>
                    <p><strong>Remarks: </strong>{{ $clearance->remarks }}</p>
                    <p><strong>Requested by: </strong> {{ $clearance->resident->full_name }}</p>
                    <p><strong>Processed by: </strong> {{ $clearance->user?->first_name ?? 'N/A' }}</p>

                    <a href="{{ route('clearance.index') }}"
                        class="mt-6 inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>