<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('File a Blotter Report') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('blotters.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Incident Type</label>
                        <input type="text" name="incident_type"
                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Date</label>
                        <input type="date" name="incident_date"
                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Time</label>
                        <input type="time" name="incident_time"
                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Location</label>
                        <input type="text" name="location"
                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Description</label>
                        <textarea name="description"
                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                            required></textarea>
                    </div>

                    <x-primary-button type="button" class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        File Report
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>