@section('title') {{ 'Admin Dashboard' }} @endsection

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </div>
    </x-slot>

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
                                    {{ auth()->user()->full_name }}!
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

            <!-- Statistics Cards -->
            <div class="row mb-4 g-3">
                @if(auth()->user()->role === 'admin')
                    <!-- Total Users -->
                    <div class="col-lg-3 col-md-4 col-sm-4 mb-2">
                        <div class="enhanced-stat-card users-card admin-card">
                            <div class="stat-icon">
                                <i class="bi bi-person-gear"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number" data-count="{{ $stats['users_count'] }}">0</h3>
                                <p class="stat-label">Users</p>
                            </div>
                            <div class="stat-trend">
                                <i class="bi bi-shield-check"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Staff Members -->
                    <div class="col-lg-3 col-md-4 col-sm-4 mb-2">
                        <a href="{{ route('admin.staff.index') }}" class="text-decoration-none">
                            <div class="enhanced-stat-card staff-card admin-card">
                                <div class="stat-icon">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div class="stat-content">
                                    <h3 class="stat-number" data-count="{{ $stats['staff_count'] }}">0</h3>
                                    <p class="stat-label">Staff</p>
                                </div>
                                <div class="stat-trend">
                                    <i class="bi bi-person-plus"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                <div class="col-lg-3 col-md-4 col-sm-4 mb-2">
                    <div class="enhanced-stat-card residents-card">
                        <div class="stat-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number" data-count="{{ $stats['residents_count'] }}">0</h3>
                            <p class="stat-label">Residents</p>
                        </div>
                        <div class="stat-trend">
                            <i class="bi bi-graph-up"></i>
                        </div>
                    </div>
                </div>
                <!-- Activities-->
                <div class="col-lg-3 col-md-4 col-sm-4 mb-2">
                    <a href="{{ route('activities.index') }}" class="text-decoration-none">
                        <div class="enhanced-stat-card announcements-card">
                            <div class="stat-icon">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number" data-count="{{ $stats['activities_count'] }}">0</h3>
                                <p class="stat-label">Activities</p>
                            </div>
                            <div class="stat-trend">
                                <i class="bi bi-calendar-plus"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Announcements -->
                <div class="col-lg-3 col-md-4 col-sm-4 mb-2">
                    <a href="{{ route('announcements.index') }}" class="text-decoration-none">
                        <div class="enhanced-stat-card announcements-card">
                            <div class="stat-icon">
                                <i class="bi bi-megaphone"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number" data-count="{{ $stats['announcements_count'] }}">0</h3>
                                <p class="stat-label">Announcements</p>
                            </div>
                            <div class="stat-trend">
                                <i class="bi bi-plus-circle"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Pending Reports -->
                <div class="col-lg-3 col-md-4 col-sm-4 mb-2">
                    <a href="{{ route('blotters.index') }}" class="text-decoration-none">
                        <div class="enhanced-stat-card reports-card">
                            <div class="stat-icon">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number" data-count="{{ $stats['blotter_reports_pending'] }}">0</h3>
                                <p class="stat-label">Blotter Reports</p>
                            </div>
                            <div class="stat-trend">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!--CLEARANCE-->
                <div class="col-lg-3 col-md-4 col-sm-4 mb-2">
                    <a href="{{ route('clearances.index') }}" class="text-decoration-none">
                        <div class="enhanced-stat-card clearances-card">
                            <div class="stat-icon">
                                <i class="bi bi-file-earmark-check"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number" data-count="{{ $stats['clearances_pending'] }}">0</h3>
                                <p class="stat-label">Clearances</p>
                            </div>
                            <div class="stat-trend">
                                <i class="bi bi-clock"></i>
                            </div>
                        </div>
                    </a>
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
            </div>
        </div>
</x-app-layout>