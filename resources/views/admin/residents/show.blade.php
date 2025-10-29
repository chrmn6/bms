<!-- Details Card -->
<div class="col-lg-12">
    <div class="card-body">
        <div class="row">
            <!-- Profile Picture -->
            <div class="col-auto mx-2">
                @php
                    $hasImage = $resident->profile->image && !empty($resident->profile->image) &&
                        file_exists(public_path('uploads/residents/' . $resident->image));
                @endphp

                @if($hasImage)
                    <img src="{{ asset('uploads/residents/' . $resident->profile->image) }}" alt="Profile Photo"
                        class="rounded-circle"
                        style="width: 115px; height: 115px; object-fit: cover; border: 3px solid #6D0512;">
                @else
                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow"
                        style="width: 115px; height: 115px; background: linear-gradient(135deg, #6D0512, #8B4513); border: 3px solid #8B4512;">
                        <i class="bi bi-person text-white" style="font-size: 4rem; line-height: 1;"></i>
                    </div>
                @endif
                <p class="text-sm fw-semibold mt-2 mb-0">Member since<br>
                    <span class="text-sm text-muted">{{ $resident->created_at->format('F d, Y') }}</span>
                </p>
            </div>

            <!-- Profile Info -->
            <div class="col">
                <div class="row g-4">
                    <div class="col-lg-12 text-xs fw-bold">
                        <h3>Basic Information</h3>
                    </div>
                    <!-- First Name, Middle Name, Last Name, Suffix -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">First Name</label>
                        <p>{{ $resident->user->first_name }}</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Last Name</label>
                        <p>{{ $resident->user->last_name }}</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Middle Name</label>
                        <p>{{ $resident->middle_name ?: 'N/A' }}</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Suffix</label>
                        <p>{{ $resident->suffix ?: 'N/A' }}</p>
                    </div>
                </div>

                <!-- Age, Birthday, Gender, Place of Birth -->
                <div class="row g-4">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Age</label>
                        <p>{{ $resident->profile->date_of_birth->age }} years old</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Gender</label>
                        <p>{{ $resident->profile->gender }}</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Date of Birth</label>
                        <p>{{ $resident->profile->date_of_birth?->format('m/d/y') }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Place of Birth</label>
                        <p>{{ $resident->profile->place_of_birth }}</p>
                    </div>
                </div>

                <!-- Household Number, Street Address-->
                <div class="row g-3 mb-1">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Email Address</label>
                        <p>{{ $resident->user->email }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Household Number</label>
                        <p>{{ $resident->household->household_number }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Street Address</label>
                        <p>{{ $resident->address }}</p>
                    </div>
                </div>

                <!-- Additional Information-->
                <div class="row g-4">
                    <div class="col-lg-12 text-xs fw-bold">
                        <h3>Additional Information</h3>
                    </div>
                    <!-- Civil Status, Education, Citizenship, Employment Status-->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Civil Status</label>
                        <p>{{ $resident->details->civil_status }}</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Education</label>
                        <p>{{ $resident->details->education}}</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Citizenship</label>
                        <p>{{ $resident->details->citizenship }}</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Employment</label>
                        <p>{{ $resident->details->occupation }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>