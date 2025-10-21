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
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Announcement Details') }}
        </h2>
        {{--
    </x-slot> --}}

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Header --}}
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                        <h1 class="h2 mb-0">
                            <i class="bi bi-megaphone"></i>
                            Announcement Details
                        </h1>
                        <a href="{{ route('staff.announcements.index') }}" class="btn btn-secondary">
                            Back
                        </a>
                    </div>

                    {{-- Card --}}
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-transparent border-bottom-0">
                            <h6 class="mb-0 font-semibold">Posted by: {{ $announcement->user->first_name }}</h6>
                        </div>

                        {{-- Content --}}
                        <div class="card-body d-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="fw-bold mb-2">{{ $announcement->title }}</h4>
                                <p class="mb-0 text-lg">{{ $announcement->content }}</p>
                            </div>

                            <div class="d-flex gap-2">
                                @can('update', $announcement)
                                    <button type="submit"
                                        class="!bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700 border-[#dc2626] flex items-center justify-center p-2 text-white"
                                        onclick="window.location='{{ route('staff.announcements.edit', $announcement) }}'">
                                        <ion-icon name="pencil-outline"></ion-icon>
                                    </button>
                                @endcan
                                @can('delete', $announcement)
                                    <form method="POST" action="{{ route('staff.announcements.destroy', $announcement) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this announcement?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>

                        {{-- Footer --}}
                        <div
                            class="card-footer d-flex justify-content-between align-items-center bg-transparent border-top">
                            <small class="text-muted">
                                <i class="bi bi-clock"></i>
                                Published {{ $announcement->created_at->diffForHumans() }}
                                @if ($announcement->updated_at != $announcement->created_at)
                                    • Updated {{ $announcement->updated_at->diffForHumans() }}
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>