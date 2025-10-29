@section('title') {{ 'Blotter Report' }} @endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/users-styles.css') }}">
@endpush

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
            <!-- Success Message -->
            <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer">
                <div class="toast align-items-center text-bg-success border-0 d-none" id="successToast" role="alert"
                    aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body text-center" id="toastMessage">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>

            <!-- ONLY ADMIN AND STAFF CAN SEE THE Statistics Cards -->
            @auth
                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'staff')
                    <div class="row mb-2">
                        @php
        $blotter = \App\Models\Blotter::all();
        $pending = $blotter->where('status', 'pending')->count();
        $processing = $blotter->where('status', 'processing')->count();
        $approved = $blotter->where('status', 'approved')->count();
        $rejected = $blotter->where('status', 'rejected')->count();
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
                                            <h6 class="text-info">Processing</h6>
                                            <h3 class="mb-0">{{ $processing }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="bi bi-search fa-2x text-info"></i>
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

            <!-- FILE REPORT BUTTON-->
            <div class="py-3 flex justify-end">
                @can('create', App\Models\Blotter::class)
                    <x-primary-button type="button" hx-get="{{ route('blotters.create') }}" hx-target="#blotterModalBody"
                        hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal" data-bs-target="#addBlotterModal"
                        class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] flex items-center gap-2">
                        <i class="bi bi-plus-square text-base"></i>File A Report
                    </x-primary-button>
                @endcan
            </div>

            <!-- Blotter Reports Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-table"></i>
                        Blotter Reports
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <div id="blotterList" hx-get="{{ route('blotters.index') }}"
                                hx-trigger="refreshTable from:body" hx-target="this" hx-swap="outerHTML">
                                @include('blotters.table', ['blotters' => $blotters])
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Blotter Report Modal -->
            <div class="modal fade" id="addBlotterModal" tabindex="-1" aria-labelledby="blotterModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header !bg-[#6D0512] text-white">
                            <h5 class="modal-title" id="announcementModalLabel">
                                <i class="bi bi-megaphone me-2"></i> File Blotter Report
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="blotterModalBody">
                            <div class="text-center py-5 text-muted">
                                <div class="spinner-border text-primary mb-3" role="status"></div>
                                <p>Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View Blotter Modal -->
            <div class="modal fade" id="viewBlotterModal" tabindex="-1" aria-labelledby="viewBlotterModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-m modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header !bg-[#6D0512] text-white">
                            <h5 class="modal-title" id="viewBlotterModalLabel">
                                <i class="bi bi-file-earmark me-2"></i>Blotter Report Transcript
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="viewBlotterModalBody">
                            <div class="text-center py-5 text-muted">
                                <div class="spinner-border text-primary mb-3" role="status"></div>
                                <p>Loading transcript details...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal-->
            <div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header !bg-[#6D0512] text-white py-2">
                            <h6 class="modal-title" id="editStatusModalLabel">Edit Status</h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
            
                        <div class="modal-body p-3" id="editStatusModalBody">
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
                {{ $blotters->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const showToast = document.querySelector('.toast');
            if (showToast) {
                const toast = new bootstrap.Toast(showToast, {
                    delay: 2000,
                    autohide: true
                });
                toast.show();
            }
        });
    </script>
</x-app-layout>