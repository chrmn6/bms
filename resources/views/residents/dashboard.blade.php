<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
    <script src="{{ asset('js/dashboard-scripts.js') }}"></script>

    @php
        $user = Auth::user();
        $resident = $user->resident;
        $profile = $resident?->profile;
        $household = $resident?->household;

        $isIncomplete = false;
        if (!$resident || !$profile || !$household) {
            $isIncomplete = true;
        } else {
            $requiredFields = [

                // residents table
                $resident->place_of_birth,
                $resident->date_of_birth,
                $resident->gender,
                $resident->address,

                // residents profile
                $profile->civil_status,
                $profile->citizenship,
                $profile->occupation,
                $profile->education,

                //household
                $household->household_number,
            ];

            foreach ($requiredFields as $field) {
                if (empty($field)) {
                    $isIncomplete = true;
                    break;
                }
            }
        }
    @endphp

    <div>
        @if ($isIncomplete)
            <div class=" bg-yellow-100 border-yellow-500 text-yellow-700 p-4 mb-6 mx-6 rounded">
                <p class="font-bold">⚠️ Please complete your profile information</p>
                <p class="text-sm mb-2">
                    You need to complete your profile information first before fully accessing the system.
                </p>
                <a href="{{ route('residents.edit') }}"
                    class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                    Complete Profile
                </a>
            </div>
        @endif
    </div>

    <div class="container px-3 px-md-4">
        <div class="main-content py-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Welcome Card -->
            <div class="welcome-card mb-4">
                <h2><i
                        class="bi bi-{{ date('H') < 12 ? 'sun' : (date('H') < 18 ? 'brightness-high' : 'moon-stars') }}"></i>
                    Good {{ date('H') < 12 ? 'Morning' : (date('H') < 18 ? 'Afternoon' : 'Evening') }},
                    {{ $resident->full_name }}!
                </h2>
                <p>Access services, view announcements, and stay connected with your community.</p>
            </div>

            <!-- Quick Actions -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card action-card text-center">
                        <div class="card-body">
                            <i class="bi bi-file-earmark-text text-primary"></i>
                            <h6 class="card-title">Request Clearance</h6>
                            <p class="card-text text-muted">Apply for clearance online.</p>
                            <a href="#" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Request Now
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card action-card text-center">
                        <div class="card-body">
                            <i class="bi bi-exclamation-triangle text-warning"></i>
                            <h6 class="card-title">File Blotter Report</h6>
                            <p class="card-text text-muted">Report incidents to barangay officials.</p>
                            <a href="#" class="btn btn-warning">
                                <i class="bi bi-plus-circle"></i> File Report
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card action-card text-center">
                        <div class="card-body">
                            <i class="bi bi-person-circle text-info"></i>
                            <h6 class="card-title">My Profile</h6>
                            <p class="card-text text-muted">View and update your information</p>
                            <a href="#" class="btn btn-info">
                                <i class="bi bi-pencil"></i> View Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- My Clearance Requests -->
                <div class="col-lg-6 mb-4">
                    <div class="card section-card">
                        <div class="card-header">
                            <h5><i class="bi bi-file-earmark-check"></i> My Clearance Requests</h5>
                        </div>
                        <div class="card-body">
                            @if($clearances->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Purpose</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($clearances as $clearance)
                                                <tr>

                                                    <td>{{ $clearance->purpose }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-{{ $clearance->status == 'approved' ? 'success' : ($clearance->status == 'pending' ? 'warning' : 'danger') }}">
                                                            {{ ucfirst($clearance->status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $clearance->created_at->format('M d, Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-2">No clearance requests yet.</p>
                                    <a href="#" class="btn btn-sm btn-primary">Request your first
                                        clearance</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Announcements -->
                <div class="col-lg-6 mb-4">
                    <div class="card section-card">
                        <div class="card-header">
                            <h5><i class="bi bi-megaphone"></i> Latest Announcements</h5>
                        </div>
                        <div class="card-body">
                            @if($announcements->count() > 0)
                                @foreach($announcements->take(5) as $announcement)
                                    <div class="announcement-item">
                                        <h6>{{ $announcement->title }}</h6>
                                        <p class="mb-1">{{ Str::limit($announcement->content, 100) }}</p>
                                        <small>
                                            <i class="bi bi-calendar"></i>
                                            {{ $announcement->created_at->format('M d, Y') }}
                                        </small>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i class="bi bi-megaphone text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-2">No announcements available.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activities -->
            <div class="row">
                <div class="col-12">
                    <div class="card section-card">
                        <div class="card-header">
                            <h5><i class="bi bi-calendar-event"></i> Upcoming Activities</h5>
                        </div>
                        <div class="card-body">
                            @if($activities->count() > 0)
                                    <div class="row">
                                        @foreach($activities->take(3) as $activity)
                                                <div class="col-md-4 mb-3">
                                                    <div class="card h-100">
                                                        <div class="card-body">
                                                            <h6 class="card-title text-primary">{{ $activity->title }}
                                                            </h6>
                                                            <p class="card-text small">
                                                                {{ Str::limit($activity->description, 80) }}
                                                            </p>
                                                            <small class="text-muted">
                                                                <i class="bi bi-calendar"></i>
                                                                {{ \Carbon\Carbon::parse($activity->event_date)->format('M d, Y') }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                </div>
                            @else
                            <div class="text-center py-4">
                                <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-2">No upcoming activities.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <a href="{{ route('resident.barangay-clearance', $resident->resident_id) }}" class="btn btn-primary">Download
        Barangay Clearance</a>
    <a href="{{ route('resident.business-clearance', $resident->resident_id) }}" class="btn btn-primary">Download
        Business Clearance</a>
    <a href="{{ route('resident.residency-clearance', $resident->resident_id) }}" class="btn btn-primary">Download
        Residency Clearance</a> --}}
    </div>

    <script>
        const successAlert = document.querySelector('.alert-success');
        if (successAlert) {
            setTimeout(function () {
                const bsAlert = new bootstrap.Alert(successAlert);
                bsAlert.close();
            }, 5000);
        }
    </script>
</x-app-layout>