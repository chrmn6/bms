@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/users-styles.css') }}">
@endpush

@section('title') {{ 'Manage Users' }} @endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Staff List
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3 flex justify-end">
            <x-primary-button type="button" hx-get="{{ route('admin.staff.create') }}" hx-target="#userModalBody"
                hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal" data-bs-target="#userModal"
                class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] flex items-center gap-1">
                <i class="bi bi-plus-circle text-base"></i>Add New User
            </x-primary-button>
        </div>

        <!-- Users Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-table"></i> System Users
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @include('admin.users.table', ['users' => $users])
                </div>
            </div>
        </div>

        <!-- Add User Modal -->
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header !bg-[#6D0512] text-white">
                        <h5 class="modal-title" id="userModalLabel">
                            <i class="bi bi-person-circle me-2"></i> User Management
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
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header !bg-[#6D0512] text-white">
                        <h5 class="modal-title" id="viewUserModalLabel">
                            <i class="bi bi-person-circle me-2"></i> User Details
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

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>