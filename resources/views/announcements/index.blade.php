<x-app-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/users-styles.css') }}">
    @endpush

    @push('scripts')
        <script src="{{ asset('js/dashboard-scripts.js') }}"></script>
        <script src="{{ asset('js/users-scripts.js') }}"></script>
    @endpush

    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Announcements
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Main Content List --}}
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                        <h1 class="h2">
                            <i class="bi bi-megaphone"></i>
                            List of Announcements
                        </h1>
                        @can('create', App\Models\Announcement::class)
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addAnnouncementModal">
                                    <i class="bi bi-plus-circle"></i>
                                    Create Announcement
                                </button>
                            </div>
                        @endcan
                    </div>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Announcements Table/List --}}
                    <div class="row">
                        @forelse($announcements as $announcement)
                            <div class="col-lg-6 mb-4">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">{{ $announcement->title }}</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ Str::limit($announcement->content, 150) }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                By {{ $announcement->user->first_name }} •
                                                {{ $announcement->created_at->diffForHumans() }}
                                            </small>
                                            <div class="btn-group" role="group">
                                                <a href="#" class="btn btn-sm btn-outline-info" title="View"
                                                    hx-get="{{ route('announcements.show', $announcement) }}"
                                                    hx-target="#announcementModalBody" hx-trigger="click"
                                                    hx-swap="innerHTML" data-bs-toggle="modal"
                                                    data-bs-target="#announcementModal">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                {{-- Edit --}}
                                                @can('update', $announcement)
                                                    <a href="{{ route('staff.announcements.edit', $announcement) }}"
                                                        class="btn btn-sm btn-outline-warning" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                @endcan

                                                {{-- Delete --}}
                                                @can('delete', $announcement)
                                                    <form method="POST"
                                                        action="{{ route('staff.announcements.destroy', $announcement) }}"
                                                        style="display:inline;"
                                                        onsubmit="return confirm('Are you sure you want to delete this announcement?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            title="Delete">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="card text-center py-5">
                                    <div class="card-body">
                                        <i class="bi bi-megaphone-fill fa-3x text-muted mb-3"></i>
                                        <h4>No Announcements Yet</h4>
                                        <p class="text-muted">Create your first announcement to keep residents informed.
                                        </p>
                                        @can('create', App\Models\Announcement::class)
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#addAnnouncementModal">
                                                <i class="bi bi-plus-circle"></i>
                                                Create First Announcement
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Add Announcement Modal --}}
                @can('create', App\Models\Announcement::class)
                    <div class="modal fade" id="addAnnouncementModal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Create New Announcement</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addAnnouncementForm" method="POST"
                                        action="{{ route('staff.announcements.store') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea class="form-control" id="content" name="content" rows="6"
                                                required></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" form="addAnnouncementForm" class="btn btn-primary">Create
                                        Announcement</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan

                <!-- Show Announcement Modal -->
                <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg">

                            <!-- Modal Header -->
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="announcementModalLabel">
                                    <i class="bi bi-megaphone me-2"></i> Announcement Details
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body" id="announcementModalBody">
                                <div class="text-center py-5 text-muted" id="announcementLoading">
                                    <div class="spinner-border text-primary mb-3" role="status"></div>
                                    <p>Loading announcement...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>