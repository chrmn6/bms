<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Request a clearance') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('clearances.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="clearance_type" class="block text-gray-700 dark:text-gray-300 font-medium">Clearance
                            Type</label>
                        <select id="clearance_type" name="clearance_type" required
                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            <option value="">Select type</option>
                            <option value="Barangay Clearance">Barangay Clearance</option>
                            <option value="Business Clearance">Business Clearance</option>
                            <option value="Residency Certificate">Residency Certificate</option>
                        </select>
                        @error('clearance_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="purpose" class="block text-gray-700 dark:text-gray-300 font-medium">Purpose</label>
                        <textarea id="purpose" name="purpose" rows="3" required
                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                            placeholder="Explain why you need this clearance"></textarea>
                        @error('purpose')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-primary-button type="button" class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Submit Request
                    </x-primary-button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>