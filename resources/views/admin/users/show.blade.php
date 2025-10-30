<div class="p-4">
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">User ID:</div>
        <div class="col-8">{{ $staff->id }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Full Name:</div>
        <div class="col-8">{{ $staff->full_name }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Email:</div>
        <div class="col-8">{{ $staff->email }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Phone:</div>
        <div class="col-8">{{ $staff->phone_number ?? '—' }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Role:</div>
        <div class="col-8">
            <span class="badge bg-success">{{ ucfirst($staff->role) }}</span>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Status:</div>
        <div class="col-8">
            <span class="badge bg-success">{{ $staff->status ?? 'Active' }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-4 fw-semibold text-secondary">Created At:</div>
        <div class="col-8">{{ $staff->created_at->format('M d, Y') }}</div>
    </div>
</div>