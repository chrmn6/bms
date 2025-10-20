<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>

            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    @if(auth()->user()->role === 'staff')
                        <span class="badge bg-primary fs-6">Staff Member</span>
                    @endif
                </div>
            </div>
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
                                    {{ $user->last_name }}
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
            <div class="row mb-2 g-3">
                @if(auth()->user()->role === 'staff')
                    <!-- Total Users -->
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                        <div class="enhanced-stat-card users-card admin-card">
                            <div class="stat-icon">
                                <i class="bi bi-person-gear"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number" data-count="{{ $stats['users_count'] }}">0</h3>
                                <p class="stat-label">Total Users</p>
                            </div>
                            <div class="stat-trend">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div class="stat-progress">
                                <div class="stat-progress-bar"></div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="enhanced-stat-card residents-card">
                        <div class="stat-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number" data-count="{{ $stats['residents_count'] }}">0</h3>
                            <p class="stat-label">Total Residents</p>
                        </div>
                        <div class="stat-trend">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <div class="stat-progress">
                            <div class="stat-progress-bar"></div>
                        </div>
                    </div>
                </div>

                <!-- Announcements -->
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
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
                            <div class="stat-progress">
                                <div class="stat-progress-bar"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Second Row -->
            <div class="row mb-2 g-3">
                <!-- Pending Reports -->
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                    <a href="{{ route('blotters.index') }}" class="text-decoration-none">
                        <div class="enhanced-stat-card reports-card">
                            <div class="stat-icon">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number" data-count="{{ $stats['blotter_reports_pending'] }}">0</h3>
                                <p class="stat-label">Pending Reports</p>
                            </div>
                            <div class="stat-trend">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <div class="stat-progress">
                                <div class="stat-progress-bar"></div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                    <a href="{{ route('clearance.index') }}" class="text-decoration-none">
                        <div class="enhanced-stat-card clearances-card">
                            <div class="stat-icon">
                                <i class="bi bi-file-earmark-check"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number" data-count="{{ $stats['clearances_pending'] }}">0</h3>
                                <p class="stat-label">Pending Clearances</p>
                            </div>
                            <div class="stat-trend">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="stat-progress">
                                <div class="stat-progress-bar"></div>
                            </div>
                        </div>
                    </a>
                </div>


                <!-- Announcements -->
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
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
                            <div class="stat-progress">
                                <div class="stat-progress-bar"></div>
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
                                    <div class="d-flex mb-3 pb-3 border-bottom">
                                        <div class="flex-shrink-0">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                <i class="bi bi-megaphone text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">{{ $announcement->title }}</h6>
                                            <p class="mb-1 text-muted small">{{ Str::limit($announcement->content, 100) }}</p>
                                            <small class="text-muted">
                                                By {{ $announcement->user->first_name }} {{ $announcement->user->last_name }} •
                                                {{ $announcement->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-center">
                                    <a href="{{ route('announcements.index') }}" class="btn btn-sm btn-outline-primary">View
                                        All</a>
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
                                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                <i class="bi bi-calendar-event text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">{{ $activity->title }}</h6>
                                            <p class="mb-1 text-muted small">{{ Str::limit($activity->description, 80) }}</p>
                                            <small class="text-muted">
                                                <i class="bi bi-geo-alt"></i> {{ $activity->location }} •
                                                <i class="bi bi-calendar"></i> {{ $activity->date_time->format('M d, Y') }}
                                                <span
                                                    class="badge 
                                                                                                                                                                                                                                                                                        @if($activity->status === 'scheduled') bg-warning
                                                                                                                                                                                                                                                                                        @elseif($activity->status === 'completed') bg-success
                                                                                                                                                                                                                                                                                        @elseif($activity->status === 'canceled') bg-danger
                                                                                                                                                                                                                                                                                        @else bg-secondary
                                                                                                                                                                                                                                                                                        @endif">
                                                    {{ ucfirst($activity->status) }}
                                                </span>
                                            </small>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-center">
                                    <a href="{{ route('activities.index') }}" class="btn btn-sm btn-outline-success">View
                                        All</a>
                                </div>
                            @else
                                <div class="text-center text-muted py-4">
                                    <i class="bi bi-calendar-event-fill fa-3x mb-3"></i>
                                    <p>No activities scheduled.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>