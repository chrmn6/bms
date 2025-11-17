@section('title', 'Programs')

<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="py-3">
            <div class="flex items-center justify-between">
                <h5 class="text-base font-semibold text-gray-500 dark:text-gray-100">
                    Programs
                </h5>

                @can('create', App\Models\Program::class)
                    <x-primary-button type="button" hx-get="{{ route('admin.programs.create') }}"
                        hx-target="#programModalBody" hx-swap="innerHTML" data-bs-toggle="modal"
                        data-bs-target="#addProgramModal"
                        class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] flex items-center gap-1">
                        <svg class="w-[15px] h-[15px] me-1 text-white dark:text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                        </svg>
                        Create
                    </x-primary-button>
                @endcan
            </div>

            {{-- Programs Card --}}
            <div id="programCard" hx-get="{{ route('admin.programs.index') }}" hx-trigger="refreshTable from:body"
                hx-target="this" hx-swap="innerHTML" class="pt-2 flex flex-wrap gap-4">
                @include('admin.programs.card', ['programs' => $programs])
            </div>

            <!-- Add Program Modal -->
            <div class="modal fade" id="addProgramModal" tabindex="-1" aria-labelledby="programModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="bg-[#FAFAFA] modal-content border-0 shadow-lg">
                        <div class="modal-header !bg-[#6D0512] text-white py-2">
                            <h5 class="modal-title" id="programModalLabel">
                                <i class="bi bi-file-earmark me-2"></i>Create Program
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="programModalBody">
                            <div class="text-center py-5 text-muted">
                                <div class="spinner-border text-primary mb-3" role="status"></div>
                                <p>Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal-->
            <div class="modal fade" id="editProgramModal" tabindex="-1" aria-labelledby="editProgramModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-m">
                    <div class="bg-[#FAFAFA] modal-content border-0 shadow-lg">
                        <div class="modal-header !bg-[#6D0512] text-white py-2">
                            <h6 class="modal-title" id="editProgramModalLabel">Edit Program</h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body p-3" id="editProgramModalBody">
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

    <script>
        document.body.addEventListener('programCreated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Program created successfully!',
                showConfirmButton: false,
                timer: 2000,
                width: '400px',
            });
        });

        document.body.addEventListener('programUpdated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Program updated successfully!',
                showConfirmButton: false,
                timer: 2000,
                width: '400px',
            });
        });

        document.body.addEventListener('programJoined', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'You have joined successfully!',
                showConfirmButton: false,
                timer: 2000,
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
</x-app-layout>