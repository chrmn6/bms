@section('title') {{ 'Clearance' }} @endsection

@php
    $layout = auth()->user()->role === 'resident' ? 'resident-layout' : 'app-layout';

    //  CLEARANCE COUNTS
    $pending = $clearances->where('status', 'pending')->count();
    $approved = $clearances->where('status', 'approved')->count();
    $released = $clearances->where('status', 'released')->count();
    $rejected = $clearances->where('status', 'rejected')->count();
@endphp

<x-dynamic-component :component="$layout">
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Clearance
            </h2>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto sm:px-8 lg:px-8">
        <div class="py-3">
            <h5 class="text-base font-semibold mb-3 text-gray-500 dark:text-gray-100">Clearances</h5>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div
                    class="flex items-center justify-between flex-column flex-wrap md:flex-row gap-4 py-4 pb-4 bg-white dark:bg-gray-900">
                    <!--SEARCH BAR-->
                    <div class="flex justify-between w-full p-3">
                        <div class="flex gap-2 flex-wrap">
                            <button
                                class="px-1.5 py-1 text-xs rounded-md border-2 !border-gray-200 bg-gray-100 text-gray-700 font-semibold shadow-inner hover:bg-gray-200">
                                All ({{ $clearances->count() }})
                            </button>
                            <button
                                class="px-1.5 py-1 text-xs rounded-md border-2 !border-yellow-200 !bg-yellow-100 !text-yellow-700 font-semibold shadow-inner hover:bg-yellow-200">
                                Pending ({{ $pending }})
                            </button>
                            <button
                                class="px-1.5 py-1 text-xs rounded-md border-2 !border-green-200 bg-green-100 text-green-700 font-semibold shadow-inner hover:bg-green-200">
                                Approved ({{ $approved }})
                            </button>
                            <button
                                class="px-1.5 py-1 text-xs rounded-md border-2 !border-blue-200 !bg-blue-100 !text-blue-700 font-semibold shadow-inner hover:bg-blue-200">
                                Released ({{ $released }})
                            </button>
                            <button
                                class="px-1.5 py-1 text-xs rounded-md border-2 !border-red-200 bg-red-100 text-red-700 font-semibold shadow-inner hover:bg-red-200">
                                Rejected ({{ $rejected }})
                            </button>
                        </div>

                        @can('create', App\Models\Clearance::class)
                            <x-primary-button type="button" hx-get="{{ route('clearances.create') }}"
                                hx-target="#clearanceModalBody" hx-swap="innerHTML" hx-trigger="click"
                                data-bs-toggle="modal" data-bs-target="#addClearanceModal"
                                class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] flex items-center">
                                <svg class="w-[15px] h-[15px] me-1 text-white dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 12h14m-7 7V5" />
                                </svg>Request
                            </x-primary-button>
                        @endcan
                    </div>

                    <!--CLEARANCE LIST-->
                    @include('clearance.table', ['clearances' => $clearances])

                    <!-- Add Blotter Report Modal -->
                    <div class="modal fade" id="addClearanceModal" tabindex="-1" aria-labelledby="clearanceModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="bg-[#FAFAFA] modal-content border-0 shadow-lg">
                                <div class="modal-header !bg-[#6D0512] text-white">
                                    <h5 class="modal-title" id="clearanceModalLabel">
                                        <i class="bi bi-file-earmark me-2"></i>Request Clearance
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
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
                    <div class="modal fade" id="viewClearanceModal" tabindex="-1"
                        aria-labelledby="viewClearanceModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-m modal-dialog-centered">
                            <div class="bg-[#FAFAFA] modal-content border-0 shadow-lg">
                                <div class="modal-header !bg-[#6D0512] text-white">
                                    <h5 class="modal-title" id="viewClearanceModalLabel">
                                        <i class="bi bi-file-earmark me-2"></i>Clearance Request Transcript
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
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
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
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

                    <!--PAGINATION-->
                    <div class="flex">
                        <!-- Previous Button -->
                        <a href="{{ $clearances->onFirstPage() ? '#' : $clearances->previousPageUrl() }}"
                            class="flex items-center justify-center px-3 h-8 me-3 text-sm font-medium 
                                      {{ $clearances->onFirstPage() ? 'text-blue-400 bg-blue-200 cursor-not-allowed' : 'text-blue-500 bg-white hover:bg-blue-100 hover:text-blue-700' }}
                                      !no-underline border !border-blue-300 rounded-md dark:bg-blue-800 dark:border-blue-700 dark:text-blue-400 dark:hover:bg-blue-700 dark:hover:text-white">
                            <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                            </svg>
                            Previous
                        </a>

                        <!-- Next Button -->
                        <a href="{{ $clearances->hasMorePages() ? $clearances->nextPageUrl() : '#' }}"
                            class="flex items-center justify-center px-3 h-8 text-sm font-medium 
                                      {{ $clearances->hasMorePages() ? 'text-blue-500 bg-blue hover:bg-blue-100 hover:text-blue-700' : 'text-blue-400 bg-blue-200 cursor-not-allowed' }}
                                      !no-underline border !border-blue-300 rounded-md dark:bg-blue-800 dark:blue-gray-700 dark:text-blue-400 dark:hover:bg-blue-700 dark:hover:text-white">
                            Next
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert Messages -->
    <script>
        document.body.addEventListener('clearanceCreated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: event.detail.value,
                showConfirmButton: false,
                timer: 2000
            });
        });

        document.body.addEventListener('clearanceUpdated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: event.detail.value,
                showConfirmButton: false,
                timer: 2000
            });
        });

        document.body.addEventListener('closeModal', function () {
            const modalEl = document.querySelector('.modal.show');
            if (modalEl) {
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();
            }
        });
    </script>
</x-dynamic-component>