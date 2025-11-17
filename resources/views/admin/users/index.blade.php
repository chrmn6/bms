@section('title') {{ 'Manage Users' }} @endsection

<x-app-layout>

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">
            <h5 class="text-base font-semibold mb-3 text-gray-500 dark:text-gray-100">Barangay Staff</h5>
            <div class="items-center justify-between gap-4 pb-4 bg-neutral-50 dark:bg-gray-900 shadow-md sm:rounded-lg">
                <!--SEARCH BAR-->
                <div class="flex justify-end w-full p-3">
                    <x-primary-button type="button" hx-get="{{ route('admin.staff.create') }}"
                        hx-target="#userModalBody" hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal"
                        data-bs-target="#userModal"
                        class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] flex items-center gap-1">
                        Add Staff
                    </x-primary-button>
                </div>

                <!-- Residents Table -->
                <div class="overflow-y-auto h-64 border">
                    @include('admin.users.table', ['users' => $users])
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>

        <!-- Add User Modal -->
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="bg-neutral-50 modal-content border-0 shadow-lg">
                    <div class="modal-header !bg-[#6D0512] text-white py-2">
                        <h5 class="modal-title" id="userModalLabel">
                            Add New User
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="userModalBody">
                        <div class="text-center py-5 text-muted">
                            <div class="spinner-border text-primary mb-3" role="status"></div>
                            <p>Loading...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- View User Modal -->
        <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="bg-neutral-50 modal-content border-0 shadow-lg">
                    <div class="modal-header !bg-[#6D0512] text-white py-2">
                        <h5 class="modal-title" id="viewUserModalLabel">
                            User Details
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

        <!--EDIT USER--->
        <div class="modal fade" id="editStaffModal" tabindex="-1" aria-labelledby="editStaffModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="bg-neutral-50 modal-content border-0 shadow-lg">
                    <div class="modal-header !bg-[#6D0512] text-white py-2">
                        <h5 class="modal-title" id="editStaffModalLabel">Edit User</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-3" id="editStaffModalBody">
                        <div class="text-center text-muted">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p>Loading...</p>
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
                timer: 2000,
                width: '400px',
            });
        });

        document.body.addEventListener('staffUpdated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: event.detail.value,
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