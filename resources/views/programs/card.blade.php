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
                {{ $program->program_date->format('Y-m-d') }}
            </div>
            <!-- Location -->
            <div class="flex items-center gap-1 text-sm">
                <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                        d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                        d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                </svg>
                {{ $program->location }}
            </div>
        </div>

        <div class="flex gap-27 mb-1 text-xs text-body">
            <!--TIME-->
            <div class="flex items-center gap-1 text-sm">
                <svg class="w-[15px] h-[15px] text-gray-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1"
                        d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                {{ $program->time->format('g:i A') }}
            </div>

            <!-- Attendees -->
            <div class="flex items-center gap-1 text-sm">
                <svg class="w-[15px] h-[15px] text-gray-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="1.2"
                        d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                </svg>
                {{ $program->attendees_count }} Attendees
            </div>
        </div>
        <div class="flex justify-end">
            <!-- Status -->
            @php
                $statusTextColor = [
                    'Planned' => 'text-blue-600',
                    'Ongoing' => 'text-yellow-600',
                    'Completed' => 'text-green-600',
                    'Cancelled' => 'text-red-600',
                ];
            @endphp
            <div class="flex items-center font-semibold text-sm {{ $statusTextColor[$program->status] }}">
                {{ $program->status }}
            </div>
        </div>

        <div class="mt-2 flex flex-col gap-2 w-full">
            @php
                $user = auth()->user();
                $isResident = $user->role === 'resident';
                $hasJoined = $isResident && $user->resident && $program->residents->contains($user->resident->resident_id);
            @endphp

            @if($isResident)
                @if($hasJoined)
                    <x-primary-button type="button" disabled
                        class="w-full !bg-[#6D0512] cursor-not-allowed flex justify-center items-center gap-1 px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                        Joined
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </x-primary-button>
                @else
                    <form hx-post="{{ route('programs.join', $program) }}" hx-swap="outerHTML" hx-target="closest .program-card">
                        @csrf
                        <x-primary-button type="submit"
                            class="w-full !bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] flex justify-center items-center gap-1">
                            JOIN
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 12H5m14 0-4 4m4-4-4-4" />
                            </svg>
                        </x-primary-button>
                    </form>
                @endif
            @endif

            @can('update', $program)
                <form hx-put="{{ route('programs.update', $program) }}" hx-target="#programCard" hx-swap="innerHTML"
                    hx-trigger="change from:select">
                    @csrf
                    @method('PUT')
                    <select name="status" class="w-full border border-gray-500 bg-gray-600 text-black rounded-md p-2 text-sm">
                        <option value="Planned" {{ $program->status == 'Planned' ? 'selected' : '' }}>Planned</option>
                        <option value="Ongoing" {{ $program->status == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="Completed" {{ $program->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ $program->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </form>
            @endcan
        </div>
    </div>
@endforeach