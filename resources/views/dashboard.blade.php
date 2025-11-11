@section('title') {{ 'Dashboard' }} @endsection

@push('scripts')
    <script src="{{ asset('js/dashboard-scripts.js') }}"></script>
@endpush

<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16">
        <div class="py-3">
            <!-- Statistics Cards -->
            <div class="flex flex-wrap gap-2">
                <!-- Households -->
                <div>
                    <x-stat-card cardBg="bg-orange-100" textColor="text-orange-500" iconColor="bg-orange-400"
                        :count="$stats['households_count']" label="HOUSEHOLD">
                        <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.3"
                                d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                        </svg>
                    </x-stat-card>
                </div>

                <!-- Residents -->
                <a href="{{ route('admin.resident.index') }}" style="text-decoration: none;">
                    <x-stat-card cardBg="bg-yellow-100" textColor="text-yellow-500" iconColor="bg-yellow-400"
                        :count="$stats['residents_count']" label="RESIDENTS">
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.3"
                                d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                        </svg>
                    </x-stat-card>
                </a>

                <!-- Blotter -->
                <a href="{{ route('blotters.index') }}" style="text-decoration: none;">
                    <x-stat-card cardBg="bg-indigo-100" textColor="text-indigo-500" iconColor="bg-indigo-500"
                        :count="$stats['blotter_reports_pending']" label="BLOTTER">
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Zm-4 1h.01v.01H15V5Zm-2 2h.01v.01H13V7Zm2 2h.01v.01H15V9Zm-2 2h.01v.01H13V11Zm2 2h.01v.01H15V13Zm-2 2h.01v.01H13V15Zm2 2h.01v.01H15V17Zm-2 2h.01v.01H13V19Z" />
                        </svg>
                    </x-stat-card>
                </a>

                <!-- Clearances -->
                <a href="{{ route('clearances.index') }}" style="text-decoration: none;">
                    <x-stat-card cardBg="bg-green-100" textColor="text-green-500" iconColor="bg-green-500"
                        :count="$stats['clearances_pending']" label="CLEARANCE">
                        <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M10 3v4a1 1 0 0 1-1 1H5m4 6 2 2 4-4m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                        </svg>
                    </x-stat-card>
                </a>
            </div>
        </div>

        <!--CHARTS-->
        <div class="grid grid-cols-2 gap-4 mt-2 mb-3">
            <div class="bg-neutral-50 shadow rounded-md p-4 mt-2">
                <h5 class="font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    Total Population
                </h5>
                <div id="population-donut-chart" data-male='@json($male)' data-female='@json($female)'>
                </div>
            </div>

            <div class="bg-neutral-50 shadow rounded-md p-4 mt-2">
                <h5 class="font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    Total Blotter Reports
                </h5>
                <div id="blotter-report-stacked-chart" data-locations='@json($locations)' data-series='@json($series)'>
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
                timer: 2000
            });
        </script>
    @endif
</x-app-layout>