@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/users-styles.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dashboard-scripts.js') }}"></script>
    <script src="{{ asset('js/users-scripts.js') }}"></script>
@endpush

@section('title') {{ 'Residents Information' }} @endsection


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Residents List') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">
            <div class="flex justify-end mb-2">
                <x-primary-button type="button" onclick="window.location.href='{{ route('admin.resident.index') }}'">
                    Back
                </x-primary-button>
            </div>

            <!-- Details Card -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-info-circle"></i>
                            Personal Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Profile Picture -->
                            <div class="col-auto mx-3">
                                @php
                                    $hasImage = $resident->profile->image && !empty($resident->profile->image) &&
                                        file_exists(public_path('uploads/residents/' . $resident->image));
                                @endphp

                                @if($hasImage)
                                    <img src="{{ asset('uploads/residents/' . $resident->profile->image) }}"
                                        alt="Profile Photo" class="rounded-circle"
                                        style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #6D0512;">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow"
                                        style="width: 150px; height: 150px; background: linear-gradient(135deg, #6D0512, #8B4513); border: 3px solid #8B4512;">
                                        <i class="bi bi-person text-white" style="font-size: 4rem; line-height: 1;"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Profile Info -->
                            <div class="col">
                                <div class="row g-3">
                                    <div class="col-lg-12 font-bold mt-3">
                                        <h4>Basic Information</h4>
                                    </div>
                                    <!-- First Name, Middle Name, Last Name -->
                                    <div class="col-md-4">
                                        <label class="form-label text-muted">First Name</label>
                                        <p class="fw-bold">{{ $resident->user->first_name }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label text-muted">Last Name</label>
                                        <p class="fw-bold">{{ $resident->user->last_name }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label text-muted">Middle Name</label>
                                        <p class="fw-bold">{{ $resident->middle_name ?: 'N/A' }}</p>
                                    </div>

                                    <!-- Suffix, Age, Gender -->
                                    <div class="col-md-4">
                                        <label class="form-label text-muted">Suffix</label>
                                        <p class="fw-bold">{{ $resident->suffix ?: 'N/A' }}</p>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label text-muted">Age</label>
                                        <p class="fw-bold">{{ $resident->profile->date_of_birth->age }} years old</p>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label text-muted">Gender</label>
                                        <p class="fw-bold">{{ $resident->profile->gender }}</p>
                                    </div>

                                    <!-- Date of Birth and Place of Birth -->
                                    <div class="col-md-4">
                                        <label class="form-label text-muted">Date of Birth</label>
                                        <p class="fw-bold">{{ $resident->profile->date_of_birth?->format('F d, Y') }}
                                        </p>
                                    </div>

                                    <div class="col-md-8">
                                        <label class="form-label text-muted">Place of Birth</label>
                                        <p class="fw-bold">{{ $resident->profile->place_of_birth }}</p>
                                    </div>

                                    <!-- Household Number, Street Address-->
                                    <div class="col-md-4">
                                        <label class="form-label text-muted">Household Number</label>
                                        <p class="fw-bold">{{ $resident->household->household_number }}</p>
                                    </div>

                                    <div class="col-md-8">
                                        <label class="form-label text-muted">Street Address</label>
                                        <p class="fw-bold">{{ $resident->address }}</p>
                                    </div>

                                    <!-- Additional Information-->
                                    <div class="col-lg-12 font-bold mt-3">
                                        <h4>Additional Information</h4>
                                    </div>

                                    <!-- Civil Status, Education, Citizenship-->
                                    <div class="col-md-4">
                                        <label class="form-label text-muted">Civil Status</label>
                                        <p class="fw-bold">{{ $resident->details->civil_status }}</p>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label text-muted">Education</label>
                                        <p class="fw-bold">{{ $resident->details->education}}</p>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label text-muted">Citizenship</label>
                                        <p class="fw-bold">{{ $resident->details->citizenship }}</p>
                                    </div>

                                    <!-- Occupation and Email Address-->
                                    <div class="col-md-4">
                                        <label class="form-label text-muted">Occupation</label>
                                        <p class="fw-bold">{{ $resident->details->occupation }}</p>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label text-muted">Email Address</label>
                                        <p class="fw-bold">{{ $resident->user->email }}</p>
                                    </div>

                                    <!-- Date of Membership-->
                                    <div class="col-md-6">
                                        <label class="form-label text-muted">Record Created</label>
                                        <p class="fw-bold">{{ $resident->created_at->format('F d, Y - g:i A') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted">Last Updated</label>
                                        <p class="fw-bold">{{ $resident->updated_at->format('F d, Y - g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>