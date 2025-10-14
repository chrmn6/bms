<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clearance Request') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @can('create', App\Models\Clearance::class)
                        <form action="{{ route('clearance.create') }}" method="GET">
                            <x-primary-button class="mt-2">
                                Request A Clearance
                            </x-primary-button>
                        </form>
                    @endcan

                    <table class="table-auto mt-3 w-full border border-gray-300 dark:border-gray-600">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Clearance Type</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Purpose</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Issued Date</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Valid Date</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Status</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Remarks</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clearances as $clearance)
                                <tr class="border-b border-gray-200 dark:border-gray-600">
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                        {{ $clearance->clearance_type }}
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">
                                        {{ $clearance->purpose }}
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">
                                        {{ $clearance->issued_date }}
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">
                                        {{ $clearance->valid_until }}
                                    </td>
                                    <td
                                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center
                                                    {{ $clearance->status == 'pending' ? 'text-yellow-600 font-semibold' : '' }}
                                                    {{ $clearance->status == 'released' ? 'text-orange-600 font-semibold' : '' }}
                                                    {{ $clearance->status == 'approved' ? 'text-green-600 font-semibold' : '' }}
                                                    {{ $clearance->status == 'rejected' ? 'text-red-600 font-semibold' : '' }}">
                                        {{ ucfirst($clearance->status) }}
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">
                                        {{ $clearance->remarks }}
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 align-middle">
                                        <div class="flex gap-2 justify-center">
                                            <x-primary-button type="button"
                                                class="p-1.5 rounded flex items-center justify-center"
                                                onclick="window.location.href='{{ route('clearance.show', $clearance->clearance_id) }}'">
                                                <ion-icon name="eye-outline" class="text-lg"></ion-icon>
                                            </x-primary-button>

                                            @can('update', $clearance)
                                                <x-primary-button type="button"
                                                    class="p-1.5 rounded flex items-center justify-center"
                                                    onclick="window.location.href='{{ route('clearance.edit', $clearance->clearance_id) }}'">
                                                    <ion-icon name="pencil-outline" class="text-lg"></ion-icon>
                                                </x-primary-button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center p-4 text-gray-500">No clearance requests found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $clearances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>