@section('title') {{ 'Activities' }} @endsection

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
            <div id='calendar' class="bg-white rounded-lg shadow-md p-4 mx-auto" style="max-width: 900px;"></div>
        </div>
    </div>

    <!-- Add Activity Modal -->
    <div class="modal fade" id="addActivityModal" tabindex="-1" aria-labelledby="activityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header !bg-[#6D0512] text-white">
                    <h5 class="modal-title" id="activityModalLabel">
                        <i class="bi bi-file-earmark me-2"></i> Create Activity
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
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header !bg-[#6D0512] text-white">
                    <h5 class="modal-title" id="viewActivityModalLabel">
                        <i class="bi bi-file-earmark me-2"></i>Activity
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
            <div class="modal-content border-0 shadow-lg">
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
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'today',
                    center: 'title',
                    right: 'dayGridMonth'
                },
                contentHeight: 350,
                events: [
                    @foreach($activities as $activity)
                                                    {
                            title: '{{ $activity->title }}',
                            start: '{{ $activity->date_time }}',
                            color: '{{ $activity->status === 'completed' ? '#16a34a' : ($activity->status === 'canceled' ? '#dc2626' : '#facc15') }}',
                            id: '{{ $activity->activity_id }}',
                        },
                    @endforeach
                ],
                dayCellDidMount: function (info) {
                    const date = info.date;
                    const day = date.getUTCDay();
                    if (day === 6) {
                        info.el.style.backgroundColor = '#e5e7eb';
                        info.el.style.pointerEvents = 'auto';
                    }
                },
                dateClick: function (info) {
                    const clickedDate = info.date;
                    const day = clickedDate.getUTCDay();

                    if (day === 6) {
                        alert('No operation on Sundays');
                        return;
                    }

                    htmx.ajax('GET', '{{ route('activities.create') }}', {
                        target: '#activityModalBody',
                        swap: 'innerHTML'
                    });

                    const modalElement = document.getElementById('addActivityModal');
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                },
                eventClick: function (info) {
                    info.jsEvent.preventDefault();
                    const activityId = info.event.id;

                    htmx.ajax('GET', `/activities/${activityId}`, {
                        target: '#viewActivityModalBody',
                        swap: 'innerHTML'
                    });
                    const modalElement = document.getElementById('viewActivityModal');
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                }
            });
            calendar.render();
        });
    </script>
</x-app-layout>