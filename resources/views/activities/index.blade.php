@section('title') {{ 'Activities' }} @endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
@endpush

@php
    $layout = Auth::user()->role === 'resident' ? 'resident-layout' : 'app-layout';
@endphp

<x-dynamic-component :component="$layout">
    <div
        class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 @if(Auth::user() && (Auth::user()->role === 'admin' || Auth::user()->role === 'staff')) @endif">
        <div class="py-3">
            <div id='calendar' class="bg-[#FAFAFA] rounded-lg shadow-md p-4 mx-auto"></div>
        </div>
    </div>

    <!-- Add Activity Modal -->
    <div class="modal fade" id="addActivityModal" tabindex="-1" aria-labelledby="activityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header !bg-[#6D0512] text-white py-2">
                    <h5 class="modal-title" id="activityModalLabel">
                        Create Activity
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="activityModalBody">
                    <div class="text-center py-5 text-muted">
                        <div class="spinner-border text-primary mb-3" role="status"></div>
                        <p>Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Activity Modal -->
    <div class="modal fade" id="viewActivityModal" tabindex="-1" aria-labelledby="viewActivityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-m modal-dialog-centered">
            <div class="bg-[#FAFAFA] modal-content border-0 shadow-lg">
                <div class="modal-header !bg-[#6D0512] text-white py-2">
                    <h5 class="modal-title" id="viewActivityModalLabel">
                        Activity
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="viewActivityModalBody">
                    <div class="text-center py-5 text-muted">
                        <div class="spinner-border text-primary mb-3" role="status"></div>
                        <p>Loading activity details...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal-->
    <div class="modal fade" id="editActivityModal" tabindex="-1" aria-labelledby="editActivityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-m">
            <div class="bg-[#FAFAFA] modal-content border-0 shadow-lg">
                <div class="modal-header !bg-[#6D0512] text-white py-2">
                    <h6 class="modal-title" id="editActivityModalLabel">Edit Activity</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-3" id="editActivityModalBody">
                    <div class="text-center text-muted">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p>Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Functions -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    start: 'title',
                    right: 'dayGridMonth,listWeek'
                },
                contentHeight: 350,
                events: '{{ route('activities.events') }}',
                dayCellDidMount: function (info) {
                    if (info.date.getDay() === 0) {
                        info.el.style.backgroundColor = '#f5f5f5';
                        info.el.style.color = '#999';
                        info.el.style.pointerEvents = 'none';
                        info.el.title = "No operations on Sundays";
                    }
                },
                dateClick: function (info) {
                    const role = "{{ Auth::user()->role }}";
                    const clickedDate = new Date(info.dateStr);
                    const today = new Date();

                    today.setHours(0, 0, 0, 0);
                    clickedDate.setHours(0, 0, 0, 0);

                    if (clickedDate.getDay() === 0) {
                        Swal.fire({
                            icon: 'warning',
                            text: "No operations on Sundays.",
                            width: '400px',
                            confirmButtonColor: '#6D0512'
                        });
                        return;
                    }

                    if (role === 'staff' && clickedDate < today) {
                        Swal.fire({
                            icon: 'error',
                            text: "You cannot create an activity in the past.",
                            confirmButtonColor: '#6D0512',
                            width: '400px',
                        });
                        return;
                    }

                    if (role === 'staff') {
                        htmx.ajax('GET', '{{ route('activities.create') }}?date=' + info.dateStr, {
                            target: '#activityModalBody',
                            swap: 'innerHTML'
                        });
                        new bootstrap.Modal(document.getElementById('addActivityModal')).show();
                    } else {
                        Swal.fire({
                            icon: 'info',
                            text: "You can only view activities.",
                            confirmButtonColor: '#6D0512',
                            width: '400px',
                        });
                    }
                },

                eventClick: function (info) {
                    info.jsEvent.preventDefault();
                    htmx.ajax('GET', `/activities/${info.event.id}`, {
                        target: '#viewActivityModalBody',
                        swap: 'innerHTML'
                    });
                    new bootstrap.Modal(document.getElementById('viewActivityModal')).show();
                }
            });
            calendar.render();

            document.body.addEventListener('refreshTable', function () {
                calendar.refetchEvents();
            });
        });
    </script>

    <!-- SweetAlert Messages -->
    <script>
        document.body.addEventListener('activityCreated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: event.detail.value,
                showConfirmButton: false,
                timer: 2000,
                width: '400px',
            });
        });

        document.body.addEventListener('activityUpdated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: event.detail.value,
                showConfirmButton: false,
                timer: 2000,
                width: '400px',
            });
        });

        document.body.addEventListener('closeModal', function () {
            const modalEl = document.querySelector('.modal.show');
            if (modalEl) {
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();
            }
        });
    </script>
</x-dynamic-component>