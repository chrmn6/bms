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
            <h1 class="h2">
                <i class="bi bi-person-vcard"></i>
                Resident Details
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{ route('admin.resident.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Back to List
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Profile Card -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        @php
                            $hasImage = $resident->profile_image &&
                                !empty($resident->profile_image) &&
                                file_exists(public_path('storage/residents/' . $resident->profile_image));
                        @endphp

                        @if($hasImage)
                            <img src="{{ asset('storage/residents/' . $resident->profile_image) }}" alt="Profile Photo"
                                class="rounded-circle mb-3"
                                style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #B76E79;">
                        @else
                            <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow"
                                style="width: 150px; height: 150px; background: linear-gradient(135deg, #B76E79, #8B4513); border: 3px solid #8B4513; min-height: 150px;">
                                <i class="bi bi-person text-white" style="font-size: 4rem; line-height: 1;"></i>
                            </div>
                        @endif

                        <h4 class="card-title">{{ $resident->full_name }}</h4>
                        <p class="card-text">
                            <span class="badge bg-primary fs-6">{{ $resident->unique_id }}</span>
                        </p>

                        <div class="row text-center mt-3">
                            <div class="col-6">
                                <div class="border-end">
                                    <h5 class="mb-0">{{ $resident->date_of_birth->age }}</h5>
                                    <small class="text-muted">Years Old</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <h5 class="mb-0">{{ $resident->clearances->count() }}</h5>
                                <small class="text-muted">Clearances</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Details Card -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-info-circle"></i>
                            Personal Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">First Name</label>
                                <p class="fw-bold">{{ $resident->user->first_name }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Middle Name</label>
                                <p class="fw-bold">{{ $resident->middle_name ?: 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Last Name</label>
                                <p class="fw-bold">{{ $resident->user->last_name }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Birth Date</label>
                                <p class="fw-bold">{{ $resident->date_of_birth?->format('F d, Y') }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Gender</label>
                                <p>
                                    <span
                                        class="badge {{ $resident->gender == 'Male' ? 'bg-info' : 'bg-warning' }} fs-6">
                                        {{ $resident->gender }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Civil Status</label>
                                <p class="fw-bold">{{ $resident->profile->civil_status }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Address</label>
                                <p class="fw-bold">{{ $resident->address }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Contact Number</label>
                                <p class="fw-bold">{{ $resident->contact_number ?: 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Record Created</label>
                                <p class="fw-bold">{{ $resident->created_at->format('F d, Y - g:i A') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Last Updated</label>
                                <p class="fw-bold">{{ $resident->updated_at->format('F d, Y - g:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Clearances History -->
                <div class="card mt-4">
                    <div class="card-body">
                        @if($resident->clearances->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Purpose</th>
                                            <th>Status</th>
                                            <th>Issued Date</th>
                                            <th>Requested</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($resident->clearances->take(5) as $clearance)
                                            <tr>
                                                <td>{{ $clearance->purpose }}</td>
                                                <td>
                                                    @php
                                                        $statusClass = match ($clearance->status) {
                                                            'approved' => 'bg-success',
                                                            'rejected' => 'bg-danger',
                                                            default => 'bg-warning'
                                                        };
                                                    @endphp
                                                    <span
                                                        class="badge {{ $statusClass }}">{{ ucfirst($clearance->status) }}</span>
                                                </td>
                                                <td>{{ $clearance->issued_date ? $clearance->issued_date->format('M d, Y') : 'N/A' }}
                                                </td>
                                                <td>{{ $clearance->created_at->format('M d, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>