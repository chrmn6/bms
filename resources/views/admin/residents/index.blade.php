@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/users-styles.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dashboard-scripts.js') }}"></script>
    <script src="{{ asset('js/users-scripts.js') }}"></script>
@endpush

@section('title') {{ 'Residents List' }} @endsection


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Residents List') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">
            <!-- Search and Filter Section -->
            <div class="card mb-3 shadow-sm border-0" style="background-color:#6D0512;">
                <div class="card-body py-3">
                    <form method="GET" action="{{ route('admin.resident.index') }}">
                        <div class="row g-2 align-items-end">
                            <!-- Search by Name -->
                            <div class="col-md-4">
                                <label for="search" class="form-label mb-1 font-xs text-white">Name</label>
                                <input type="text" class="form-control form-control-sm" id="search" name="search"
                                    value="{{ request('search') }}" placeholder="Search by first or last name">
                            </div>

                            <!-- Search by Household Number -->
                            <div class="col-md-4">
                                <label for="household_number" class="form-label mb-1 text-white font-xs">Household
                                    No.</label>
                                <input type="text" class="form-control form-control-sm" id="household_number"
                                    name="household_number" value="{{ request('household_number') }}"
                                    placeholder="Enter household number">
                            </div>

                            <!-- Search Button -->
                            <div class="col-md-2 d-flex align-items-end">
                                <x-primary-button type="submit"
                                    class="![background-color:#6D0512] hover:![background-color:#8A0A1A] active:![background-color:#50040D] w-100 text-sm py-1.5">
                                    <ion-icon name="search-outline" class="text-sm me-1"></ion-icon>
                                    Search
                                </x-primary-button>
                            </div>

                            <!-- Clear Filters Button -->
                            @if(request()->hasAny(['search', 'household_number']))
                                <div class="col-md-2 d-flex align-items-end text-white">
                                    <a href="{{ route('admin.resident.index') }}"
                                        class="btn btn-outline-light btn-sm w-100">
                                        <i class="bi bi-x-circle me-1"></i> Clear
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Residents Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-table"></i>
                        Residents ({{ $residents->total() }} total)
                    </h5>
                </div>
                <div class="card-body text-center">
                    @if($residents->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Household Number</th>
                                        <th>Mobile Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($residents as $resident)
                                        <tr>
                                            <td>{{ $resident->resident_id }}</td>
                                            <td>{{ $resident->user->last_name }}</td>
                                            <td>{{ $resident->user->first_name }}</td>
                                            <td>{{ $resident->household->household_number }}</td>
                                            <td>{{ $resident->user->phone_number }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.resident.show', $resident->resident_id) }}">
                                                        <x-primary-button type="button"
                                                            class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700">
                                                            <ion-icon name="eye-outline" class="text-sm"></ion-icon>
                                                        </x-primary-button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $residents->withQueryString()->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-person-x fa-3x text-muted mb-3"></i>
                            <h4>No Residents Found</h4>
                            <p class="text-muted">
                                @if(request()->hasAny(['search', 'gender', 'civil_status']))
                                    No residents match your search criteria.
                                @else
                                    No residents have been added yet.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>