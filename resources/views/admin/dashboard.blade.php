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


    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-3">
            <!-- Statistics Cards -->
            <div class="flex flex-wrap gap-2 mb-4">
                @if(auth()->user()->role === 'admin')
                    <!-- Total Users -->
                    <x-stat-card bgColor="bg-blue-500"
                        :count="$stats['users_count']" label="Total Users">
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.3"
                                d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                        </svg>
                    </x-stat-card>

                    <a href="{{ route('admin.staff.index') }}" style="text-decoration: none;">
                        <x-stat-card bgColor="bg-green-500"
                            :count="$stats['staff_count']" label="Staff Members">
                            <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="1.3"
                                    d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </x-stat-card>
                    </a>
                @endif

                <!-- Residents -->
                <a href="{{ route('admin.resident.index') }}" style="text-decoration: none;">
                    <x-stat-card bgColor="bg-yellow-500"
                        :count="$stats['residents_count']" label="Residents">
                        <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M7 6H5m2 3H5m2 3H5m2 3H5m2 3H5m11-1a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2M7 3h11a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Zm8 7a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
                        </svg>
                    </x-stat-card>
                </a>

                <a href="{{ route('blotters.index') }}" style="text-decoration: none;">
                    <x-stat-card bgColor="bg-red-500"
                        :count="$stats['blotter_reports_pending']" label="Blotter Reports">
                        <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Zm-4 1h.01v.01H15V5Zm-2 2h.01v.01H13V7Zm2 2h.01v.01H15V9Zm-2 2h.01v.01H13V11Zm2 2h.01v.01H15V13Zm-2 2h.01v.01H13V15Zm2 2h.01v.01H15V17Zm-2 2h.01v.01H13V19Z" />
                        </svg>
                    </x-stat-card>
                </a>

                <a href="{{ route('clearances.index') }}" style="text-decoration: none;">
                    <x-stat-card bgColor="bg-indigo-500"
                        :count="$stats['clearances_pending']" label="Clearances">
                        <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M10 3v4a1 1 0 0 1-1 1H5m4 6 2 2 4-4m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                        </svg>
                    </x-stat-card>
                </a>
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
</x-app-layout>