<table id="blotterTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
    hx-get="{{ route('blotters.index') }}" hx-trigger="refreshTable from:body" hx-target="this" hx-swap="outerHTML">
    <thead class="text-base text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-2 py-2 md:px-3 md:py-2 text-sm md:text-sm">Case #</th>
            <th scope="col" class="px-2 py-2 md:px-3 md:py-2 text-sm md:text-sm">Complainant</th>
            <th scope="col" class="px-2 py-2 md:px-3 md:py-2 text-sm md:text-sm">Date Reported</th>
            <th scope="col" class="px-2 py-2 md:px-3 md:py-2 text-sm md:text-sm">Status</th>
            <th scope="col" class="px-2 py-2 md:px-3 md:py-2 text-sm md:text-sm">Mediated By</th>
            <th scope="col" class="px-2 py-2 md:px-3 md:py-2 text-sm md:text-sm">Actions</th>
        </tr>
    </thead>
    <tbody class="text-center border border-gray-200 dark:border-gray-700 rounded-lg">
        @forelse($blotters as $blotter)
            <tr data-status="{{ $blotter->status }}"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 divide-x divide-gray-100">
                <td class="px-2 py-2 text-center">
                    {{ $blotter->display_id }}
                </td>
                <td class="px-1 py-2">{{ $blotter->resident->full_name }}</td>
                <td class="px-2 py-2">{{ $blotter->incident_date }}</td>
                <td class="px-2 py-2">
                    @php
                        $statusColors = match ($blotter->status) {
                            'resolved' => ['bg' => 'bg-green-100', 'text' => 'text-green-700'],
                            'investigating' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700'],
                            'dismissed' => ['bg' => 'bg-red-100', 'text' => 'text-red-700'],
                            'pending' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700'],
                            default => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700']
                        };
                    @endphp

                    <span
                        class="px-1.5 py-1 rounded-md font-semibold text-xs {{ $statusColors['bg'] }} {{ $statusColors['text'] }}">
                        {{ ucfirst($blotter->status) }}
                    </span>
                </td>
                <td class="px-2 py-2">{{ $blotter->user?->full_name ?? 'N/A' }}</td>
                <td class="px-2 py-2">
                    <x-primary-button hx-get="{{ route('blotters.show', $blotter->blotter_id) }}"
                        hx-target="#viewBlotterModalBody" hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal"
                        data-bs-target="#viewBlotterModal"
                        class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700 flex items-center justify-center">
                        <svg class="w-[15px] h-[15px] text-white dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2"
                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </x-primary-button>
                    @can('update', $blotter)
                        <x-primary-button hx-get="{{ route('blotters.edit', $blotter->blotter_id) }}"
                            hx-target="#editStatusModalBody" hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal"
                            data-bs-target="#editStatusModal"
                            class="!bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700 flex items-center justify-center">
                            <svg class="w-[15px] h-[15px] text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                            </svg>
                        </x-primary-button>
                    @endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-muted">
                    <i class="bi bi-file-earmark"></i>
                    <p class="mb-0">No blotter reports found.</p>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>