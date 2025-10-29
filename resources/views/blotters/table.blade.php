<table id="blotterTable" class="table table-hover text-center" hx-get="{{ route('blotters.index') }}"
    hx-trigger="refreshTable from:body" hx-target="this" hx-swap="outerHTML">
    <thead class="table-light">
        <tr>
            <th>Case #</th>
            <th>Complainant</th>
            <th>Incident Type</th>
            <th>Date Reported</th>
            <th>Status</th>
            <th>Mediated By</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($blotters as $blotter)
            <tr>
                <td>{{ $blotter->blotter_id }}</td>
                <td>{{ $blotter->resident->full_name }}</td>
                <td>{{ $blotter->incident_type }}</td>
                <td>{{ $blotter->incident_date }}</td>
                <td>
                    @php
                        $statusClass = match ($blotter->status) {
                            'approved' => 'bg-success',
                            'processing' => 'bg-info',
                            'rejected' => 'bg-danger',
                            default => 'bg-warning'
                        };
                    @endphp
                    <span class="badge {{ $statusClass }}">{{ ucfirst($blotter->status) }}</span>
                </td>
                <td>{{ $blotter->user?->first_name ?? 'N/A' }} {{ $blotter->user?->last_name ?? 'N/A' }}</td>
                <td>
                    <x-primary-button hx-get="{{ route('blotters.show', $blotter->blotter_id) }}"
                        hx-target="#viewBlotterModalBody" hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal"
                        data-bs-target="#viewBlotterModal"
                        class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700 flex items-center justify-center">
                        <i class="bi bi-eye text-xs"></i>
                    </x-primary-button>
                    @can('update', $blotter)
                        <x-primary-button type="button"
                            class="!bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700 rounded flex items-center justify-center"
                            onclick="window.location.href='{{ route('blotters.edit', $blotter->blotter_id) }}'">
                            <i class="bi bi-pencil text-xs"></i>
                        </x-primary-button>
                    @endcan
                </td>
            </tr>
        @endforeach
    </tbody>
</table>