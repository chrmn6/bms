<div class="container">
    <div class="row">
        <p class="col-5 fw-bold text-lg">BLOTTER ENTRY # {{ $blotter->blotter_id }}</p>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            <p class="fw-bold text-sm mb-0">COMPLAINANT</p>
            <p class="text-sm mb-0">{{ $blotter->resident->full_name }}</p>
        </div>
        <div class="col-5">
            <p class="fw-bold text-sm mb-0">FULL ADDRESS</p>
            <p class="text-sm mb-0">{{ $blotter->resident->address }}</p>
        </div>
        <div class="col-3">
            <p class="fw-bold text-sm mb-0">CONTACT</p>
            <p class="text-sm mb-0">{{ $blotter->resident->user->phone_number }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <p class="fw-bold text-sm mb-0">TYPE OF INCIDENT</p>
            <p class="text-sm mb-0">{{ $blotter->incident_type }}</p>
        </div>
        <div class="col-6">
            <p class="fw-bold text-sm mb-0">DATE AND TIME</p>
            <p class="text-sm mb-0">{{ $blotter->incident_date}}, {{ $blotter->incident_time }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <p class="fw-bold text-sm mb-0">PLACE OF INCIDENT</p>
            <p class="text-sm mb-0">{{ $blotter->location }}</p>
        </div>
        <div class="col-6">
            <p class="fw-bold text-sm mb-0">STATUS</p>
            <span class="badge bg-success">{{ ucfirst($blotter->status) }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <p class="fw-bold text-sm mb-0">DESCRIPTION</p>
            <p class="text-sm mb-0">{{ $blotter->description}}</p>
        </div>

        <div class="col-6">
            <p class="fw-bold text-sm mb-0">PROOF OF EVIDENCE</p>
            @if($blotter->image && file_exists(public_path('uploads/blotters/' . $blotter->image)))
                <img src="{{ asset('uploads/blotters/' . $blotter->image) }}" alt="Proof of Evidence" class="img-fluid"
                    style="max-width: 200px;">
            @else
                <span class="text-muted">No image uploaded</span>
            @endif
        </div>
    </div>
</div>