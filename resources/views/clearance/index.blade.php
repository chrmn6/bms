@section('title') {{ 'Clearance' }} @endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/users-styles.css') }}">
@endpush

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Clearance
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">
            <!-- ONLY ADMIN AND STAFF CAN SEE THE Statistics Cards -->
            @auth
                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'staff')
                    <div class="row mb-2">
                        @php
        $clearance = \App\Models\Clearance::all();
        $pending = $clearances->where('status', 'pending')->count();
        $approved = $clearances->where('status', 'approved')->count();
        $released = $clearances->where('status', 'released')->count();
        $rejected = $clearances->where('status', 'rejected')->count();
                        @endphp

                        <div class="col-md-3 mb-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="text-warning">Pending</h6>
                                            <h3 class="mb-0">{{ $pending }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="bi bi-clock fa-2x text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="text-info">Released</h6>
                                            <h3 class="mb-0">{{ $released }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="bi bi-arrow-up-square fa-2x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="text-success">Approved</h6>
                                            <h3 class="mb-0">{{ $approved }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="bi bi-check-circle fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="text-secondary">Rejected</h6>
                                            <h3 class="mb-0">{{ $rejected }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="bi bi-x-circle fa-2x text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth

            <!-- REQUEST A CLEARANCE BUTTON-->
            <div class="py-3 flex justify-end">
                @can('create', App\Models\Clearance::class)
                    <x-primary-button type="button" hx-get="{{ route('clearances.create') }}"
                        hx-target="#clearanceModalBody" hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal"
                        data-bs-target="#addClearanceModal"
                        class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] flex items-center gap-1">
                        <i class="bi bi-plus-square text-sm"></i>Request Here
                    </x-primary-button>
                @endcan
            </div>

            <!-- Clearance Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-table"></i> Clearance Request
                    </h5>
                </div>
                <div class="card-body bg-[#FAFAFA]">
                    <div class="table-responsive text-sm">
                        <div id="clearanceList" hx-get="{{ route('clearances.index') }}"
                            hx-trigger="refreshTable from:body" hx-target="this" hx-swap="outerHTML">
                            @include('clearance.table', ['clearances' => $clearances])
                        </div>
                    </div>
                </div>
            </div>

            <!-- Clearance Request Modal -->
            <div class="modal fade" id="addClearanceModal" tabindex="-1" aria-labelledby="clearanceModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="bg-[#FAFAFA] modal-content border-0 shadow-lg">
                        <div class="modal-header !bg-[#6D0512] text-white">
                            <h5 class="modal-title" id="clearanceModalLabel">
                                <i class="bi bi-file-earmark me-2"></i>Request Clearance
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="clearanceModalBody">
                            <div class="text-center py-5 text-muted">
                                <div class="spinner-border text-primary mb-3" role="status"></div>
                                <p>Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View Clearance Modal -->
            <div class="modal fade" id="viewClearanceModal" tabindex="-1" aria-labelledby="viewClearanceModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-m modal-dialog-centered">
                    <div class="bg-[#FAFAFA] modal-content border-0 shadow-lg">
                        <div class="modal-header !bg-[#6D0512] text-white">
                            <h5 class="modal-title" id="viewClearanceModalLabel">
                                <i class="bi bi-file-earmark me-2"></i>Clearance Request Transcript
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="viewClearanceModalBody">
                            <div class="text-center py-5 text-muted">
                                <div class="spinner-border text-primary mb-3" role="status"></div>
                                <p>Loading transcript details...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal-->
            <div class="modal fade" id="editClearanceStatusModal" tabindex="-1"
                aria-labelledby="editClearanceStatusModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-m">
                    <div class="bg-[#FAFAFA] modal-content border-0 shadow-lg">
                        <div class="modal-header !bg-[#6D0512] text-white py-2">
                            <h6 class="modal-title" id="editClearanceStatusModalLabel">Clearance Form</h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body p-3" id="editClearanceStatusModalBody">
                            <div class="text-center text-muted">
                                <div class="spinner-border text-primary" role="status"></div>
                                <p>Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $clearances->links() }}
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</x-app-layout>