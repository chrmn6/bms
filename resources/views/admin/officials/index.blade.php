@section('title') {{ 'Manage Users' }} @endsection

<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-16">
        <div class="py-3">
            <h5 class="text-base font-semibold mb-3 text-gray-500 dark:text-gray-100">Barangay Officials</h5>
            <div class="items-center justify-between gap-4 pb-4 bg-slate-50 dark:bg-gray-900 shadow-md sm:rounded-lg">
                <!--SEARCH BAR-->
                <div class="flex justify-end w-full p-3">
                    <x-primary-button type="button" hx-get="{{ route('admin.officials.create') }}"
                        hx-target="#officialModalBody" hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal"
                        data-bs-target="#officialModal"
                        class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] flex items-center gap-1">
                        <i class="bi bi-plus-circle text-sm"></i>Add Official
                    </x-primary-button>
                </div>

                <!-- Official Table -->
                <div class="overflow-y-auto h-64 border">
                    @include('admin.officials.table', ['officials' => $officials])
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-3">
                    {{ $officials->links() }}
                </div>
            </div>

            <!-- Add Official Modal -->
            <div class="modal fade" id="officialModal" tabindex="-1" aria-labelledby="officialModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header !bg-[#6D0512] text-white">
                            <h5 class="modal-title" id="officialModalLabel">
                                Create Official
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="officialModalBody">
                            <div class="text-center py-5 text-muted">
                                <div class="spinner-border text-primary mb-3" role="status"></div>
                                <p>Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View Official Modal -->
            <div class="modal fade" id="viewOfficialModal" tabindex="-1" aria-labelledby="viewOfficialModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header !bg-[#6D0512] text-white">
                            <h5 class="modal-title" id="viewOfficialModalLabel">
                                Official Details
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="viewUserModalBody">
                            <div class="text-center py-5 text-muted">
                                <div class="spinner-border text-primary mb-3" role="status"></div>
                                <p>Loading user details...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert Messages -->
    <script>
        document.body.addEventListener('staffCreated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: event.detail.value,
                showConfirmButton: false,
                timer: 2000
            });
        });

        document.body.addEventListener('updatedCreated', function (event) {
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
</x-app-layout>