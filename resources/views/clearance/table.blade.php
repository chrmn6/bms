<table id="clearanceTable" class="table table-hover text-center" hx-get="{{ route('clearances.index') }}"
    hx-trigger="refreshTable from:body" hx-target="this" hx-swap="outerHTML">
    <thead>
        <tr>
            <th>Clearance #</th>
            <th>Requested By</th>
            <th>Clearance Type</th>
            <th>Status</th>
            <th>Processed By</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($clearances as $clearance)
            <tr>
                <td>{{ $clearance->display_id }}</td>
                <td>{{ $clearance->resident->full_name }}</td>
                <td>{{ $clearance->clearance_type }}</td>
                <td>
                    @php
                        $statusClass = match ($clearance->status) {
                            'approved' => 'bg-success',
                            'released' => 'bg-info',
                            'rejected' => 'bg-danger',
                            default => 'bg-warning'
                        };
                    @endphp
                    <span class="badge {{ $statusClass }}">{{ ucfirst($clearance->status) }}</span>
                </td>
                <td>{{ $clearance->user?->full_name ?? 'N/A' }}</td>
                <td>
                    <x-primary-button hx-get="{{ route('clearances.show', $clearance->clearance_id) }}"
                        hx-target="#viewClearanceModalBody" hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal"
                        data-bs-target="#viewClearanceModal"
                        class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700 flex items-center justify-center">
                        <i class="bi bi-eye text-xs"></i>
                    </x-primary-button>

                    @can('update', $clearance)
                        <x-primary-button hx-get="{{ route('clearances.edit', $clearance->clearance_id) }}"
                            hx-target="#editClearanceStatusModalBody" hx-swap="innerHTML" hx-trigger="click"
                            data-bs-toggle="modal" data-bs-target="#editClearanceStatusModal"
                            class="!bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700 flex items-center justify-center">
                            <i class="bi bi-pencil text-xs"></i>
                        </x-primary-button>
                    @endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-muted">
                    <i class="bi bi-file-earmark"></i>
                    <p class="mb-0">No clearance requests found.</p>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>