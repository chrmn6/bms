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
            @can('create', App\Models\Activity::class)
                <form action="{{ route('staff.activities.create') }}" method="GET">
                    <x-primary-button class="mb-4 !bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700">
                        Create Activity
                    </x-primary-button>
                </form>
            @endcan

            <div id='calendar' class="bg-white rounded-lg shadow-md p-4 mx-auto" style="max-width: 900px;"></div>
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
                height: 600,
                events: [
                    @foreach($activities as $activity)
                                    {
                            title: '{{ $activity->title }}',
                            start: '{{ $activity->date_time }}',
                            color: '{{ $activity->status === 'completed' ? '#16a34a' : ($activity->status === 'canceled' ? '#dc2626' : '#facc15') }}',
                            url: '{{ route('activities.show', $activity->activity_id) }}'
                        },
                    @endforeach
                ],
                dayCellDidMount: function (info) {
                    if (info.date.getDay() === 0) {
                        info.el.style.backgroundColor = '#f3f3f3';
                        info.el.style.color = '#999';
                        info.el.title = 'No operation on Sundays';
                    }
                },
                dateClick: function (info) {
                    if (info.date.getDay() === 0) {
                        alert('No operation on Sundays!');
                    }
                }
            });

            calendar.render();
        });
    </script>
</x-app-layout>