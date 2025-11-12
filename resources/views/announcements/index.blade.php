@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/users-styles.css') }}">
@endpush

@section('title', 'Announcements')

@php
    $layout = auth()->user()->role === 'resident' ? 'resident-layout' : 'app-layout';
@endphp

<x-dynamic-component :component="$layout">
    <div
        class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 @if(Auth::user() && (Auth::user()->role === 'admin' || Auth::user()->role === 'staff')) pt-16 @endif">
        {{-- Add Announcement Button --}}
        <div class="py-3">
            <div class="flex items-center justify-between">
                <h5 class="text-base font-semibold text-gray-500 dark:text-gray-100">
                    Announcements
                </h5>

                @can('create', App\Models\Announcement::class)
                    <x-primary-button type="button" hx-get="{{ route('announcements.create') }}"
                        hx-target="#announcementModalBody" hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal"
                        data-bs-target="#announcementModal"
                        class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] flex items-center gap-1">
                        <svg class="w-[15px] h-[15px] me-1 text-white dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14m-7 7V5" />
                        </svg>
                        Post
                    </x-primary-button>
                @endcan
            </div>

            {{-- Announcements List --}}
            <div id="announcementsList" hx-get="{{ route('announcements.index') }}" hx-trigger="refreshTable from:body"
                hx-target="this" hx-swap="innerHTML" class="pt-2">
                @include('announcements.list', ['announcements' => $announcements])
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $announcements->links() }}
            </div>

            {{-- Announcement Modal --}}
            <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-m">
                    <div class="bg-[#FAFAFA] modal-content border-0 shadow-lg">
                        <div class="modal-header !bg-[#6D0512] text-white">
                            <h5 class="modal-title" id="announcementModalLabel">
                                <i class="bi bi-megaphone me-2"></i> Announcement
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="announcementModalBody">
                            <div class="text-center py-5 text-muted">
                                <div class="spinner-border text-primary mb-3" role="status"></div>
                                <p>Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert Messages -->
    <script>
        document.body.addEventListener('announcementCreated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: event.detail.value,
                showConfirmButton: false,
                timer: 2000,
                width: '400px',
            });
        });

        document.body.addEventListener('announcementUpdated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: event.detail.announcementUpdated,
                showConfirmButton: false,
                timer: 2000,
                width: '400px',
            });
        });
    </script>
</x-dynamic-component>