<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Activities
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        @can('create', App\Models\Activity::class)
            <form action="{{ route('staff.activities.create') }}" method="GET">
                <x-primary-button class="mb-4 !bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700">
                    Create Activity
                </x-primary-button>
            </form>
        @endcan

        <div id='calendar' class="bg-white rounded-lg shadow-md p-4"></div>
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
            });

            calendar.render();
        });
    </script>
</x-app-layout>