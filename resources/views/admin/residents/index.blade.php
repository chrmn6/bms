@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/users-styles.css') }}">
@endpush

@section('title') {{ 'Residents List' }} @endsection


<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Residents List
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">
            <!-- Search and Filter Section -->
            <div class="col-lg-8">
                <div class="card mb-3" style="background-color:#6D0512;">
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.resident.index') }}">
                            <div class="row g-1 align-items-end">
                                <!-- Search by Name -->
                                <div class="col-md-5">
                                    <label for="search" class="form-label mb-1 font-xs text-white">Name</label>
                                    <input type="text" class="form-control form-control-sm" id="search" name="search"
                                        value="{{ request('search') }}" placeholder="Search by first or last name">
                                </div>
                                <!-- Search by Household Number -->
                                <div class="col-md-5">
                                    <label for="household_number" class="form-label mb-1 text-white font-xs">Household
                                        No.</label>
                                    <input type="text" class="form-control form-control-sm" id="household_number"
                                        name="household_number" value="{{ request('household_number') }}"
                                        placeholder="Enter household number">
                                </div>
                                <!-- Search Button -->
                                <div class="col-md-2">
                                    <x-secondary-button type="submit"
                                        class="![background-color:#6D0512] hover:![background-color:#8A0A1A] active:![background-color:#50040D]">
                                        <span class="inline-flex items-center space-x-1">
                                            <i class="bi bi-search text-sm"></i>
                                            <span>Search</span>
                                        </span>
                                    </x-secondary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Residents Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-table"></i> Residents
                    </h5>
                </div>
                <div class="card-body bg-[#FAFAFA]">
                    <div class="table-responsive">
                        <table id="residentsTable" class="table table-hover text-sm text-center mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Household Number</th>
                                    <th>Phone Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($residents as $resident)
                                    <tr>
                                        <td>{{ $resident->display_id }}</td>
                                        <td>{{ $resident->user->last_name }}</td>
                                        <td>{{ $resident->user->first_name }}</td>
                                        <td>{{ $resident->household->household_number }}</td>
                                        <td>{{ $resident->user->phone_number }}</td>
                                        <td>
                                            <x-primary-button
                                                hx-get="{{ route('admin.resident.show', $resident->resident_id) }}"
                                                hx-target="#viewResidentModalBody" hx-swap="innerHTML" hx-trigger="click"
                                                data-bs-toggle="modal" data-bs-target="#viewResidentModal"
                                                aria-label="View resident details"
                                                class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700 flex items-center justify-center">
                                                <i class="bi bi-eye text-xs"></i>
                                            </x-primary-button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">
                                            <i class="bi bi-people"></i>
                                            <p class="mb-0">No residents found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $residents->links() }}
                </div>
            </div>

            <!-- View Resident Modal -->
            <div class="modal fade" id="viewResidentModal" tabindex="-1" aria-labelledby="viewResidentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header !bg-[#6D0512] text-white">
                            <h5 class="modal-title" id="viewResidentModalLabel">
                                <i class="bi bi-person-circle me-2"></i> Resident Details
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="viewResidentModalBody">
                            <div class="text-center py-5 text-muted">
                                <div class="spinner-border text-primary mb-3" role="status"></div>
                                <p>Loading resident details...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>