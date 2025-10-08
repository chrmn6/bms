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
                    <div class="mt-6">
                        {{ $blotters->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>