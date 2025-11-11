@section('title') {{ 'Resident Dashboard' }} @endsection

<x-resident-layout>

    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
    <script src="{{ asset('js/dashboard-scripts.js') }}"></script>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">

            <!-- Welcome Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="welcome-card">
                        <div class="welcome-content">
                            <div class="welcome-icon">
                                <i
                                    class="bi bi-{{ date('H') < 12 ? 'sun' : (date('H') < 18 ? 'sun' : 'moon-stars') }}"></i>
                            </div>
                            <div class="welcome-text">
                                <h3 class="welcome-greeting">
                                    Good {{ date('H') < 12 ? 'Morning' : (date('H') < 18 ? 'Afternoon' : 'Evening') }},
                                    {{ $resident->full_name }}!
                                </h3>
                                <p class="welcome-subtitle">Welcome to the Barangay Matina Gravahan Management System.
                                </p>
                            </div>
                        </div>
                        <div class="welcome-decoration">
                            <div class="decoration-circle"></div>
                            <div class="decoration-circle"></div>
                            <div class="decoration-circle"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card action-card text-center">
                        <div class="card-body">
                            <i class="bi bi-file-earmark-text text-primary"></i>
                            <h6 class="card-title">Request Clearance</h6>
                            <p class="card-text text-muted">Apply for barangay clearances online.</p>
                            <a href="{{ route('clearances.index') }}">
                                <x-primary-button type="button"
                                    class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700">
                                    Request Now
                                </x-primary-button>
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
                            <a href="{{ route('blotters.index') }}">
                                <x-primary-button type="button"
                                    class="!bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700">
                                    File Report Now
                                </x-primary-button>
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
                            <a href="{{ route('residents.edit') }}">
                                <x-primary-button type="button"
                                    class="!bg-black-500 hover:!bg-black-600 active:!bg-black-700">
                                    Edit Profile
                                </x-primary-button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Announcements & Upcoming Activities -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="bi bi-megaphone"></i>
                                Recent Announcements
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($recent_announcements->count() > 0)
                                @foreach($recent_announcements as $announcement)
                                    <div class="d-flex mb-3 pb-3 border-bottom text-sm">
                                        <div class="flex-shrink-0">
                                            <div class="bg-primary text-sm rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                <i class="bi bi-megaphone text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1 text-sm">{{ $announcement->title }}</h6>
                                            <p class="mb-1 text-muted small">
                                                {{ Str::limit($announcement->content, 100) }}
                                            </p>
                                            <small class="text-muted">
                                                By {{ $announcement->user->full_name }} •
                                                {{ $announcement->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-center">
                                    <div class="text-center">
                                        <x-primary-button type="button"
                                            class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700"
                                            onclick="window.location='{{ route('announcements.index') }}'">
                                            View All
                                        </x-primary-button>
                                    </div>
                                </div>
                            @else
                                <div class="text-center text-muted py-4">
                                    <i class="bi bi-megaphone-fill fa-3x mb-3"></i>
                                    <p>No announcements yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="bi bi-calendar-event"></i>
                                Upcoming Activities
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($recent_activities->count() > 0)
                                @foreach($recent_activities as $activity)
                                    <div class="d-flex mb-3 pb-3 border-bottom">
                                        <div class="flex-shrink-0">
                                            <div class="bg-success text-sm rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                <i class="bi bi-calendar-event text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1 text-sm">{{ $activity->title }}</h6>
                                            <p class="mb-1 text-muted small text-sm">
                                                {{ Str::limit($activity->description, 100) }}
                                            </p>
                                            <small class="text-muted">
                                                <i class="bi bi-geo-alt text-sm"></i> {{ $activity->location }} •
                                                <i class="bi bi-calendar text-sm"></i>
                                                {{ $activity->date_time->format('M d, Y') }}
                                                @php
        $statusColors = [
            'scheduled' => 'bg-warning',
            'completed' => 'bg-success',
            'canceled' => 'bg-danger',
        ];
                                                @endphp

                                                <span
                                                    class="text-sm badge {{ $statusColors[$activity->status] ?? 'bg-secondary' }}">
                                                    {{ $activity->status === 'scheduled' ? 'Schedule' : ucfirst($activity->status) }}
                                                </span>
                                            </small>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-center">
                                    <div class="text-center">
                                        <x-primary-button type="button"
                                            class="!bg-green-500 hover:!bg-green-600 active:!bg-green-700"
                                            onclick="window.location='{{ route('activities.index') }}'">
                                            View All
                                        </x-primary-button>
                                    </div>
                                </div>
                            @else
                                <div class="text-center text-muted py-4">
                                    <i class="bi bi-megaphone-fill fa-3x mb-3"></i>
                                    <p>No activities yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- My Clearance Requests -->
                <div class="col-lg-12 mb-4">
                    <div class="card section-card">
                        <div class="card-header">
                            <h5><i class="bi bi-file-earmark-check"></i> My Clearance Requests</h5>
                        </div>
                        <div class="card-body">
                            @if($clearances->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover text-sm">
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
                                    <a href="{{ route('clearances.index') }}">
                                        <x-primary-button type="button"
                                            class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700">
                                            Submit A Request
                                        </x-primary-button>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session("success") }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
</x-resident-layout>