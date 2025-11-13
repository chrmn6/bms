@section('title') {{ 'Blotter Report' }} @endsection

@php
    $layout = auth()->user()->role === 'resident' ? 'resident-layout' : 'app-layout';
@endphp

<x-dynamic-component :component="$layout">
    <div
        class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 @if(Auth::user() && Auth::user()->role === 'admin' || Auth::user()->role === 'staff') @endif">
        <div class="py-3">
            <h5 class="text-base font-semibold mb-3 text-gray-500 dark:text-gray-100">Blotter Report</h5>
            <div class="items-center justify-between gap-4 pb-4 bg-neutral-50 dark:bg-gray-900 shadow-md sm:rounded-lg">
                <!--SEARCH BAR-->
                <div class="flex justify-between items-center p-3 flex-wrap sm:flex-nowrap">
                    <!-- Texts on the left -->
                    <div class="flex flex-wrap gap-1 mb-1" id="statusFilters">
                        <button class="filter-btn p-2 text-xs font-semibold border border-gray-700 rounded-md"
                            data-status="all">
                            All
                        </button>

                        <button class="filter-btn p-2 text-xs font-semibold border border-gray-700 rounded-md"
                            data-status="pending">
                            Pending
                        </button>

                        <button class="filter-btn p-2 text-xs font-semibold border border-gray-700 rounded-md"
                            data-status="resolved">
                            Resolved
                        </button>

                        <button class="filter-btn p-2 text-xs font-semibold border border-gray-700 rounded-md"
                            data-status="dismissed">
                            Dismissed
                        </button>
                    </div>

                    <!-- Button on the right -->
                    @can('create', App\Models\Blotter::class)
                        <x-primary-button type="button" hx-get="{{ route('blotters.create') }}"
                            hx-target="#blotterModalBody" hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal"
                            data-bs-target="#addBlotterModal"
                            class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] flex items-center flex-shrink-0">
                            File Report
                        </x-primary-button>
                    @endcan
                </div>

                <!--BLOTTER LIST-->
                <div class="overflow-y-auto overflow-x-auto h-64 border">
                    @include('blotters.table', ['blotters' => $blotters])
                </div>

                <!--PAGINATION-->
                <div class="flex justify-center mt-3">
                    <!-- Previous Button -->
                    <a href="{{ $blotters->onFirstPage() ? '#' : $blotters->previousPageUrl() }}"
                        class="flex items-center justify-center px-3 h-8 me-3 text-sm font-medium 
                                  {{ $blotters->onFirstPage() ? 'text-gray-400 bg-gray-200 cursor-not-allowed' : 'text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700' }}
                                  !no-underline border !border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 5H1m0 0 4 4M1 5l4-4" />
                        </svg>
                        Previous
                    </a>

                    <!-- Next Button -->
                    <a href="{{ $blotters->hasMorePages() ? $blotters->nextPageUrl() : '#' }}"
                        class="flex items-center justify-center px-3 h-8 text-sm font-medium 
                            {{ $blotters->hasMorePages() ? 'text-gray-500 bg-gray-50 hover:bg-gray-100 hover:text-gray-700' : 'text-gray-400 bg-gray-200 cursor-not-allowed' }}
                            !no-underline border !border-gray-300 rounded-md dark:bg-gray-800 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        Next
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Add Blotter Report Modal -->
            <div class="modal fade" id="addBlotterModal" tabindex="-1" aria-labelledby="blotterModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="bg-[#FAFAFA] modal-content border-0 shadow-lg">
                        <div class="modal-header !bg-[#6D0512] text-white">
                            <h5 class="modal-title" id="announcementModalLabel">
                                <i class="bi bi-file-earmark me-2"></i> File Blotter Report
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
                    <div class="bg-[#FAFAFA] modal-content border-0 shadow-lg">
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
            <div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="bg-[#FAFAFA] modal-content border-0 shadow-lg">
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
        </div>
    </div>

    <!-- SweetAlert Messages -->
    <script>
        document.body.addEventListener('blotterCreated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'File report submitted!',
                html: event.detail.value,
                timer: 3000,
                showConfirmButton: false,
                width: '400px',
            });
        });

        document.body.addEventListener('blotterUpdated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: event.detail.value,
                showConfirmButton: false,
                timer: 3000,
                width: '400px',
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const rows = document.querySelectorAll('#blotterTable tbody tr');

            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const status = button.getAttribute('data-status');

                    rows.forEach(row => {
                        const rowStatus = row.getAttribute('data-status');
                        if (status === 'all' || rowStatus === status) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
</x-dynamic-component>