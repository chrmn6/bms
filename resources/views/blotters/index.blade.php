<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Blotter Report') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @can('create', App\Models\Blotter::class)
                        <a href="{{ route('blotters.create') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            File A Report
                        </a>
                    @endcan

                    <table class="table-auto mt-3 w-full border border-gray-300 dark:border-gray-600">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Title</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Date</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Location</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Status</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blotters as $blotter)
                                <tr class="border-b border-gray-200 dark:border-gray-600">
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                        {{ $blotter->incident_type }}
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">
                                        {{ $blotter->incident_date }}
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">
                                        {{ $blotter->location }}
                                    </td>
                                    <td
                                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center
                                                            {{ $blotter->status == 'pending' ? 'text-yellow-600 font-semibold' : '' }}
                                                            {{ $blotter->status == 'processing' ? 'text-orange-600 font-semibold' : '' }}
                                                            {{ $blotter->status == 'approved' ? 'text-green-600 font-semibold' : '' }}
                                                            {{ $blotter->status == 'rejected' ? 'text-red-600 font-semibold' : '' }}">
                                        {{ ucfirst($blotter->status) }}
                                    </td>
                                    <td class=" px-4 py-2 border border-gray-300 dark:border-gray-600 flex gap-2
                                                    justify-center">
                                        <a href="{{ route('blotters.show', $blotter->blotter_id) }}"
                                            class="px-2 py-1 bg-blue-500 text-black rounded hover:bg-blue-600 text-sm flex items-center justify-center">
                                            <ion-icon name="eye-outline" class="text-base"></ion-icon>
                                        </a>

                                        @can('update', $blotter)
                                            <a href="{{ route('blotters.edit', $blotter->blotter_id) }}"
                                                class="px-2 py-1 bg-yellow-500 text-black rounded hover:bg-yellow-600 text-sm flex items-center justify-center"><ion-icon
                                                    name="pencil-outline" class="text-base"></ion-icon>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-4 text-gray-500">No blotter reports found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="flex items-center justify-between border-t border-gray-200 bg-white py-3">
                        <div class="flex flex-1 justify-between sm:hidden">
                            <a href="#"
                                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                            <a href="#"
                                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                        </div>
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing
                                    <span class="font-medium">1</span>
                                    to
                                    <span class="font-medium">10</span>
                                    of
                                    <span class="font-medium">97</span>
                                    results
                                </p>
                            </div>
                            <div>
                                <nav aria-label="Pagination"
                                    class="isolate inline-flex -space-x-px rounded-md shadow-xs">
                                    <a href="#"
                                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                        <span class="sr-only">Previous</span>
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="size-5">
                                            <path
                                                d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                                clip-rule="evenodd" fill-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
                                    <a href="#" aria-current="page"
                                        class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">1</a>
                                    <a href="#"
                                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">2</a>
                                    <a href="#"
                                        class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex">3</a>
                                    <span
                                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 inset-ring inset-ring-gray-300 focus:outline-offset-0">...</span>
                                    <a href="#"
                                        class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex">8</a>
                                    <a href="#"
                                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">9</a>
                                    <a href="#"
                                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">10</a>
                                    <a href="#"
                                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                        <span class="sr-only">Next</span>
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="size-5">
                                            <path
                                                d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                                clip-rule="evenodd" fill-rule="evenodd" />
                                        </svg>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>