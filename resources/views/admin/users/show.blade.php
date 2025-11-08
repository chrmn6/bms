<div class="text-center" style="max-width: 400px; margin: auto;">
    <div class="d-flex justify-content-center">
        @php
            $hasImage = $staff->image && !empty($staff->image) &&
                file_exists(public_path('uploads/users/' . $staff->image));
        @endphp

        @if($hasImage)
            <img src="{{ asset('uploads/users/' . $staff->image) }}" alt="Profile Photo" class="rounded-circle"
                style="width: 100px; height: 100px; object-fit: cover; border: 2px solid #6D0512;">
        @else
            <div class="rounded-circle d-flex align-items-center justify-content-center"
                style="width: 100px; height: 100px; background: linear-gradient(135deg, #6D0512, #8B4513); border: 3px solid #8B4512;">
                <i class="bi bi-person text-white" style="font-size: 4rem; line-height: 1;"></i>
            </div>
        @endif
    </div>

    <!-- Display ID -->
    <div class="text-center mb-3">
        <h5 class="fw-semibold text-sm text-gray-500">{{ $staff->display_id }}</h5>
    </div>

    <!-- Staff Details -->
    <div class="row g-3">
        <!-- Left Column -->
        <div class="col-md-6">
            <div class="d-flex mb-2">
                <div class="fw-semibold text-secondary me-2">Full Name:</div>
                <div>{{ $staff->full_name }}</div>
            </div>
            <div class="d-flex mb-2">
                <div class="fw-semibold text-secondary me-2">Phone:</div>
                <div>{{ $staff->phone_number ?? '—' }}</div>
            </div>
            <div class="d-flex mb-2">
                <div class="fw-semibold text-secondary me-2">Status:</div>
                <div>
                    <span class="badge bg-info">{{ $staff->status ?? 'Active' }}</span>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-md-6">
            <div class="d-flex mb-2">
                <div class="fw-semibold text-secondary me-2">Email:</div>
                <div>{{ $staff->email }}</div>
            </div>
            <div class="d-flex mb-2">
                <div class="fw-semibold text-secondary me-2">Role:</div>
                <div>
                    <span class="badge bg-success text-uppercase">{{ $staff->role }}</span>
                </div>
            </div>
            <div class="d-flex mb-2">
                <div class="fw-semibold text-secondary me-2">Joined:</div>
                <div>{{ $staff->created_at->format('M d, Y') }}</div>
            </div>
        </div>
    </div>
</div>
</div>