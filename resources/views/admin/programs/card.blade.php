@foreach($programs as $program)
    <div
        class="program-card bg-slate-50 block max-w-sm p-4 border border-default rounded-md shadow-md hover:shadow-lg transition-shadow">
        <h5 class="mb-2 text-base font-bold tracking-tight text-heading">
            {{ $program->title }}
        </h5>
        <p class="mb-4 text-body text-sm">
            {{ $program->description }}
        </p>
        <div class="flex justify-between mb-1 text-xs text-body">
            <!-- Date -->
            <div class="flex items-center gap-1 text-sm">
                <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                        d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                </svg>
                {{ $program->application_start->format('m/d/y') }} - {{ $program->application_end->format('m/d/y') }}
            </div>
        </div>

        <div class="flex gap-27 mb-1 text-xs text-body">

            <!-- Attendees -->
            <div class="flex items-center gap-1 text-sm">
                <svg class="w-[15px] h-[15px] text-gray-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="1.2"
                        d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                </svg>
                {{ $program->applicants()->count() }} /
                {{ $program->applicants_limit }} Applicants
            </div>
        </div>

        @can('update', $program)
            <x-primary-button type="button" hx-get="{{ route('admin.programs.edit', $program->program_id) }}"
                hx-target="#editProgramModalBody" hx-swap="innerHTML" data-bs-toggle="modal" data-bs-target="#editProgramModal"
                class="mt-1 !bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700 flex items-center justify-center">
                Edit
            </x-primary-button>
        @endcan

        <x-primary-button onclick="window.location='{{ route('admin.programs.applicants', $program->program_id) }}'"
            class="mt-1 !bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700 flex items-center justify-center">
            View Applicants
        </x-primary-button>
    </div>
@endforeach