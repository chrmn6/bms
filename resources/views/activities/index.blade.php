@section('title') {{ 'Activities' }} @endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/users-styles.css') }}">
@endpush

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Activities
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">
            <div id='calendar' class="bg-[#FAFAFA] rounded-lg shadow-md p-4 mx-auto"></div>
        </div>
    </div>

    <!-- Add Activity Modal -->
    <div class="modal fade" id="addActivityModal" tabindex="-1" aria-labelledby="activityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header !bg-[#6D0512] text-white">
                    <h5 class="modal-title" id="activityModalLabel">
                        <i class="bi bi-globe me-2"></i>Request Clearance
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
                <div class="modal-header !bg-[#6D0512] text-white">
                    <h5 class="modal-title" id="viewActivityModalLabel">
                        <i class="bi bi-globe me-2"></i>Activity
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    start: 'today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                contentHeight: 350,
                validRange: function (nowDate) {
                    return { start: nowDate };
                },
                events: [
                    @foreach ($activities as $activity)
                                        {
                            title: '{{ $activity->title }}',
                            start: '{{ $activity->date_time }}',
                            classNames: ['{{ $activity->status }}'],
                            id: '{{ $activity->activity_id }}'
                        }
                    @endforeach
                ],
                dayCellDidMount: function (info) {
                    if (info.date.getDay() === 0) {
                        info.el.style.backgroundColor = '#f5f5f5';
                        info.el.style.color = '#999';
                        info.el.style.pointerEvents = 'none';
                        info.el.title = "No operations on Sundays";
                    }
                },
                dateClick: function (info) {
                    if (info.date.getDay() === 0) {
                        alert("No operations on Sundays.");
                        return;
                    }

                    htmx.ajax('GET', '{{ route('activities.create') }}', {
                        target: '#activityModalBody',
                        swap: 'innerHTML'
                    });
                    new bootstrap.Modal(document.getElementById('addActivityModal')).show();
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
        });
    </script>
</x-app-layout>