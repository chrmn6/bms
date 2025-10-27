@section('title') {{ 'Blotter Report' }} @endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                Blotter Report
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">

            @can('create', App\Models\Blotter::class)
                <form action="{{ route('blotters.create') }}" method="GET">
                    <x-primary-button class="mt-2 !bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700">
                        File A Report
                    </x-primary-button>
                </form>
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

                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 align-middle">
                                <div class="flex gap-2 justify-center">
                                    <x-primary-button type="button"
                                        class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700 rounded flex items-center justify-center"
                                        onclick="window.location.href='{{ route('blotters.show', $blotter->blotter_id) }}'">
                                        <ion-icon name="eye-outline" class="text-lg"></ion-icon>
                                    </x-primary-button>

                                    @can('update', $blotter)
                                        <x-primary-button type="button"
                                            class="!bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700 rounded flex items-center justify-center"
                                            onclick="window.location.href='{{ route('blotters.edit', $blotter->blotter_id) }}'">
                                            <ion-icon name="pencil-outline" class="text-lg"></ion-icon>
                                        </x-primary-button>
                                    @endcan
                                </div>
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
</x-app-layout>