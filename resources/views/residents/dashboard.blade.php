@section('title') {{ 'Resident Dashboard' }} @endsection

<x-resident-layout>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-3">
            <!-- Quick Actions -->
            <div class="row mb-3">
                <h5 class="text-base font-semibold text-gray-500 dark:text-gray-100">Quick Actions</h5>
                <!--CLEARANCE-->
                <div class="col-6 col-md-3 mb-3">
                    <div
                        class="card bg-white-50 dark:bg-gray-800 rounded-md shadow-md hover:shadow-lg transition-shadow duration-300 text-center p-4 flex flex-col items-center">
                        <svg class="w-5 h-5 text-[#6D0512] dark:text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M10 3v4a1 1 0 0 1-1 1H5m4 6 2 2 4-4m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                        </svg>
                        <h6 class="card-title text-base font-semibold">Request Clearance</h6>
                        <p class="card-text text-xs mt-0 text-gray-500 dark:text-gray-300">Request barangay
                            clearances online.</p>
                        <a href="{{ route('clearances.index') }}">
                            <x-primary-button class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
                                Request Now
                            </x-primary-button>
                        </a>
                    </div>
                </div>
                <!--BLOTTER-->
                <div class="col-6 col-md-3 mb-3">
                    <div
                        class="card bg-white-50 dark:bg-gray-800 rounded-md shadow-md hover:shadow-lg transition-shadow duration-300 text-center p-4 flex flex-col items-center">
                        <svg class="w-5 h-5 text-[#6D0512] dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        <h6 class="card-title text-base font-semibold">File Report</h6>
                        <p class="card-text text-xs mt-0 text-gray-500 dark:text-gray-300">Report incidents to
                            barangay officials.</p>
                        <a href="{{ route('blotters.index') }}">
                            <x-primary-button class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
                                File Now
                            </x-primary-button>
                        </a>
                    </div>

                </div>
                <!--PROGRAMS-->
                <div class="col-6 col-md-3 mb-3">
                    <div
                        class="card bg-white-50 dark:bg-gray-800 rounded-md shadow-md hover:shadow-lg transition-shadow duration-300 text-center p-4 flex flex-col items-center">
                        <svg class="w-5 h-5 text-[#6D0512] dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 5h6m-6 4h6M10 3v4h4V3h-4Z" />
                        </svg>

                        <h6 class="card-title text-base font-semibold">Join Programs</h6>
                        <p class="card-text text-xs mt-0 text-gray-500 dark:text-gray-300">Apply for available
                            programs.</p>
                        <a href="{{ route('programs.index') }}">
                            <x-primary-button class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
                                Apply Now
                            </x-primary-button>
                        </a>
                    </div>

                </div>
                <!--PROFILE-->
                <div class="col-6 col-md-3 mb-3">
                    <div
                        class="card bg-white-50 dark:bg-gray-800 rounded-md shadow-md hover:shadow-lg transition-shadow duration-300 text-center p-4 flex flex-col items-center">
                        <svg class="w-5 h-5 text-[#6D0512] dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>


                        <h6 class="card-title text-base font-semibold">My Profile</h6>
                        <p class="card-text text-xs mt-0 text-gray-500 dark:text-gray-300">View and update your
                            information.
                        </p>
                        <a href="{{ route('residents.edit') }}">
                            <x-primary-button class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
                                Edit Profile
                            </x-primary-button>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Request, Blotter, Program -->
            <!-- My Clearance Requests -->
            <div class="col-lg-12 mb-4">
                <div class="dark:bg-gray-900 shadow-md sm:rounded-lg overflow-hidden">
                    <div class="bg-white px-3 py-3 border-b border-gray-200 dark:border-gray-700">
                        <h5 class="text-base font-semibold text-gray-600 dark:text-gray-100">My Clearance Request</h5>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="bg-slate-50 dark:bg-gray-700 border border-gray-200 text-gray-700 dark:text-gray-400 text-center">
                                <tr>
                                    <th class="px-3 py-2 text-sm">Clearance No.</th>
                                    <th class="px-3 py-2 text-sm">Clearance Type</th>
                                    <th class="px-3 py-2 text-sm">Status</th>
                                    <th class="px-3 py-2 text-sm">Date Requested</th>
                                    <th class="px-3 py-2 text-sm">Processed By</th>
                                </tr>
                            </thead>
                            <tbody class="text-center divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($clearances as $clearance)
                                    <tr
                                        class="bg-white border-gray-200  dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-3 py-2">{{ $clearance->display_id }}</td>
                                        <td class="px-3 py-2">{{ $clearance->clearance_type }}</td>
                                        <td class="px-3 py-2">
                                            @php
                                                $statusColors = match ($clearance->status) {
                                                    'approved' => 'text-green-500',
                                                    'completed' => 'text-blue-500',
                                                    'rejected' => 'text-red-500',
                                                    'pending' => 'text-yellow-500',
                                                    default => 'text-gray-500',
                                                };
                                            @endphp
                                            <span class="px-2 py-1 rounded-md font-semibold text-sm {{ $statusColors }}">
                                                {{ ucfirst($clearance->status) }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-2">{{ $clearance->created_at->format('M d, Y') }}</td>
                                        <td class="px-3 py-2">{{ $clearance->user?->full_name ?? 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-6 text-center text-gray-500 dark:text-gray-400">
                                            <svg class="w-8 h-8 mx-auto text-[#6D0512] dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 13h3.439a.991.991 0 0 1 .908.6 3.978 3.978 0 0 0 7.306 0 .99.99 0 0 1 .908-.6H20M4 13v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-6M4 13l2-9h12l2 9M9 7h6m-7 3h8" />
                                            </svg>
                                            <p class="mt-2">No clearance requests yet.</p>
                                            <a href="{{ route('clearances.index') }}">
                                                <x-primary-button type="button"
                                                    class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
                                                    Submit A Request
                                                </x-primary-button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- My Clearance Requests -->
            <div class="col-lg-12 mb-4">
                <div class="dark:bg-gray-900 shadow-md sm:rounded-lg overflow-hidden">
                    <div class="bg-white px-3 py-3 border-b border-gray-200 dark:border-gray-700">
                        <h5 class="text-base font-semibold text-gray-600 dark:text-gray-100">My Blotter Report</h5>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="bg-slate-50 dark:bg-gray-700 border border-gray-200 text-gray-700 dark:text-gray-400 text-center">
                                <tr>
                                    <th class="px-3 py-2 text-sm">Case No.</th>
                                    <th class="px-3 py-2 text-sm">Date Reported</th>
                                    <th class="px-3 py-2 text-sm">Status</th>
                                    <th class="px-3 py-2 text-sm">Mediated By</th>
                                </tr>
                            </thead>
                            <tbody class="text-center divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($blotters as $blotter)
                                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-3 py-2">{{ $blotter->display_id }}</td>
                                        <td class="px-3 py-2">{{ $blotter->created_at->format('M d, Y') }}</td>
                                        <td class="px-3 py-2">
                                            @php
                                                $statusColors = match ($blotter->status) {
                                                    'resolved' => ['text' => 'text-green-500'],
                                                    'dismissed' => ['text' => 'text-red-500'],
                                                    'pending' => ['text' => 'text-yellow-500'],
                                                    default => ['text' => 'text-gray-500']
                                                };
                                            @endphp

                                            <span
                                                class="px-1.5 py-1 rounded-md font-semibold text-sm {{ $statusColors['text'] }}">
                                                {{ ucfirst($blotter->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2">{{ $blotter->user?->full_name ?? 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-6 text-center text-gray-500 dark:text-gray-400">
                                            <svg class="w-8 h-8 mx-auto text-[#6D0512] dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 13h3.439a.991.991 0 0 1 .908.6 3.978 3.978 0 0 0 7.306 0 .99.99 0 0 1 .908-.6H20M4 13v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-6M4 13l2-9h12l2 9M9 7h6m-7 3h8" />
                                            </svg>
                                            <p class="mt-2">No blotter reports found.</p>
                                            <a href="{{ route('blotters.index') }}">
                                                <x-primary-button type="button"
                                                    class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
                                                    File A Report
                                                </x-primary-button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session("success") }}',
                showConfirmButton: false,
                timer: 2000,
                width: '400px',
            });
        </script>
    @endif
</x-resident-layout>