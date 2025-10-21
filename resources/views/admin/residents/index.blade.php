<x-app-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/users-styles.css') }}">
    @endpush

    @push('scripts')
        <script src="{{ asset('js/dashboard-scripts.js') }}"></script>
        <script src="{{ asset('js/users-scripts.js') }}"></script>
    @endpush

    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Residents List') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">
            <!-- Search and Filter Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <form method="GET" action="{{ route('admin.resident.index') }}">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="search" class="form-label">Search</label>
                                <input type="text" class="form-control" id="search" name="search"
                                    value="{{ request('search') }}" placeholder="Search by ID, name, or address...">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender">
                                    <option value="">All Genders</option>
                                    <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="civil_status" class="form-label">Civil Status</label>
                                <select class="form-select" id="civil_status" name="civil_status">
                                    <option value="">All Status</option>
                                    <option value="Single" {{ request('civil_status') == 'Single' ? 'selected' : '' }}>
                                        Single
                                    </option>
                                    <option value="Married" {{ request('civil_status') == 'Married' ? 'selected' : '' }}>
                                        Married
                                    </option>
                                    <option value="Widowed" {{ request('civil_status') == 'Widowed' ? 'selected' : '' }}>
                                        Widowed
                                    </option>
                                    <option value="Divorced" {{ request('civil_status') == 'Divorced' ? 'selected' : '' }}>
                                        Divorced</option>
                                    <option value="Separated" {{ request('civil_status') == 'Separated' ? 'selected' : '' }}>
                                        Separated</option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3 d-flex align-items-end">
                                <x-primary-button type="submit"
                                    class="![background-color:#6D0512] hover:![background-color:#8A0A1A] active:![background-color:#50040D] flex items-center gap-2">
                                    <ion-icon name="search-outline" class="text-sm"></ion-icon>Search
                                </x-primary-button>
                            </div>
                        </div>

                        @if(request()->hasAny(['search', 'gender', 'civil_status']))
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('admin.resident.index') }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-x-circle"></i>
                                        Clear Filters
                                    </a>
                                </div>
                            </div>
                        @endif
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
                                        <th>Full Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Civil Status</th>
                                        <th>Contact</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($residents as $resident)
                                        <tr>
                                            <td>{{ $resident->resident_id }}</td>
                                            <td><strong>{{ $resident->full_name }}</strong></td>
                                            <td>{{ $resident->date_of_birth->age }} years</td>
                                            <td>
                                                <span
                                                    class="badge {{ $resident->gender == 'Male' ? 'bg-info' : 'bg-warning' }}">
                                                    {{ $resident->gender }}
                                                </span>
                                            </td>
                                            <td>{{ $resident->profile->civil_status }}</td>
                                            <td>{{ $resident->user->phone_number ?: 'N/A' }}</td>
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
                            @if(!request()->hasAny(['search', 'gender', 'civil_status']))
                                <a href="{{ route('residents.create') }}" class="btn btn-primary">
                                    <i class="bi bi-person-plus"></i>
                                    Add First Resident
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>