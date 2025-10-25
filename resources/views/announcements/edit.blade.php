@section('title') {{ 'Edit Announcement' }} @

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/users-styles.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dashboard-scripts.js') }}"></script>
    <script src="{{ asset('js/users-scripts.js') }}"></script>
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Announcement') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="d-flex justify-content-end pb-2 mb-3 border-bottom gap-2">
                        <a href="{{ route('staff.announcements.index') }}" class="btn btn-secondary">
                            Back
                        </a>
                        <button type="submit" form="updateAnnouncementForm" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Announcement
                        </button>
                    </div>

                    @can('update', $announcement)
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Edit Announcement</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="updateAnnouncementForm" method="POST"
                                            action="{{ route('staff.announcements.update', $announcement) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                    id="title" name="title" value="{{ old('title', $announcement->title) }}"
                                                    required>
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="content" class="form-label">Content</label>
                                                <textarea class="form-control @error('content') is-invalid @enderror"
                                                    id="content" name="content" rows="4"
                                                    required>{{ old('content', $announcement->content) }}</textarea>
                                                @error('content')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-600 dark:text-gray-300">
                            You do not have permission to edit this announcement.
                        </p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>