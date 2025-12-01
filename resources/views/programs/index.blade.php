@section('title', 'Programs')

<x-resident-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="py-3">
            <h5 class="text-base font-semibold text-gray-500 dark:text-gray-100">
                Programs
            </h5>
            <div class="flex flex-wrap gap-6 justify-start">
                @foreach($programs as $program)
                    <div
                        class="program-card bg-white p-4 max-w-sm border rounded-md shadow-md hover:shadow-lg transition-shadow">
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
                                {{ $program->application_start->format('m/d/y') }} -
                                {{ $program->application_end->format('m/d/y') }}
                            </div>
                        </div>

                        <div class="flex gap-27 mb-1 text-xs text-body">
                            <!-- Attendees -->
                            <div class="flex items-center gap-1 text-sm">
                                <svg class="w-[15px] h-[15px] text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="1.2"
                                        d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                </svg>
                                {{ $program->applicants()->count() }} /
                                {{ $program->applicants_limit }} Applicants
                            </div>
                        </div>

                        @php
                            $hasApplied = $program->applicants->isNotEmpty();
                            $application = $program->applicants->first();
                            $isFull = $program->applicants()->count() >= $program->applicants_limit;
                        @endphp

                        @if($hasApplied)
                            <x-primary-button type="button" disabled
                                class="mt-1 w-full !bg-[#6D0512] cursor-not-allowed flex justify-center items-center gap-1 px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                                APPLIED
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </x-primary-button>
                        @elseif($isFull)
                            <x-primary-button type="button" disabled
                                class="mt-1 w-full !bg-[#6D0512] cursor-not-allowed flex justify-center items-center gap-1 px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                                FULL
                            </x-primary-button>
                        @else
                            <x-primary-button type="button" data-bs-toggle="modal" data-bs-target="#applyModal"
                                onclick="document.getElementById('applyForm').action='{{ route('programs.join', $program) }}'"
                                class="mt-1 w-full !bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] flex justify-center items-center gap-1">
                                APPLY
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>
                            </x-primary-button>
                        @endif

                        @if($application)
                            <div class="text-sm mt-1">
                                <span class="font-semibold">Status:</span>

                                @if($application->status === 'Approved')
                                    <span class="text-green-600 font-bold">Approved</span>
                                @elseif($application->status === 'Rejected')
                                    <span class="text-red-600 font-bold">Rejected</span>
                                @else
                                    <span class="text-yellow-600 font-bold">Pending</span>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Apply Modal -->
            <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg bg-slate-50">
                        <div class="modal-header bg-[#6D0512] text-white">
                            <h5 class="modal-title" id="applyModalLabel">Apply</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="applyForm" action="" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <x-input-label for="proof_file" :value="__('Sample Proof of Evidence')" />
                                    <img src="{{ asset('storage/uploads/applicants/sample-proof.png') }}"
                                        alt="Sample Proof" class="mx-auto rounded border"
                                        style="max-width: 300px; opacity: 0.6;">
                                </div>

                                <div class="mb-3">
                                    <x-input-label for="proof_file" :value="__('Choose Image')" />
                                    <input type="file" name="proof_file" id="proof_file"
                                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                                        required>
                                </div>
                                <x-primary-button type="submit"
                                    class="w-full !bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] flex justify-center items-center gap-1">
                                    APPLY
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 12H5m14 0-4 4m4-4-4-4" />
                                    </svg>
                                </x-primary-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-resident-layout>