@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/users-styles.css') }}">
@endpush

@section('title', 'Announcements')

@php
    $componentName = auth()?->user()?->role === 'resident'
        ? 'resident-layout'
        : 'app-layout';
@endphp

<x-dynamic-component :component="$componentName">
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Announcements
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Add Announcement Button --}}
        <div class="py-3 flex justify-end">
            @can('create', App\Models\Announcement::class)
                <x-primary-button type="button" hx-get="{{ route('announcements.create') }}"
                    hx-target="#announcementModalBody" hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal"
                    data-bs-target="#announcementModal"
                    class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] flex items-center gap-1">
                    <i class="bi bi-plus-square text-sm"></i>Post
                </x-primary-button>
            @endcan
        </div>

        <div class="d-flex align-items-center mb-2">
            <h3 class="fw-semibold mb-0">Announcements</h3>
        </div>

        {{-- Announcements List --}}
        <div id="announcementsList" hx-get="{{ route('announcements.index') }}" hx-trigger="refreshTable from:body"
            hx-target="this" hx-swap="innerHTML">
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

    <!-- SweetAlert Messages -->
    <script>
        document.body.addEventListener('announcementCreated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: event.detail.value,
                showConfirmButton: false,
                timer: 2000
            });
        });

        document.body.addEventListener('announcementUpdated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: event.detail.announcementUpdated,
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
</x-dynamic-component>