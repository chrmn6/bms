@section('title') {{ 'Dashboard' }} @endsection

@push('scripts')
    <script src="{{ asset('js/dashboard-scripts.js') }}"></script>
@endpush

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">
            <!-- Statistics Cards -->
            <div class="flex flex-wrap gap-2">
                <!-- Households -->
                <div>
                    <x-stat-card cardBg="bg-gray-200" textColor="text-gray-800" iconColor="bg-gray-800"
                        :count="$stats['households_count']" label="HOUSEHOLDS">
                        <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.3"
                                d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                        </svg>
                    </x-stat-card>
                </div>

                <!-- Residents -->
                <a href="{{ route('admin.resident.index') }}" style="text-decoration: none;">
                    <x-stat-card cardBg="bg-gray-200" textColor="text-gray-800" iconColor="bg-gray-800"
                        :count="$stats['residents_count']" label="RESIDENTS">
                        <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.3"
                                d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                        </svg>
                    </x-stat-card>
                </a>

                <!-- Blotter -->
                <a href="{{ route('blotters.index') }}" style="text-decoration: none;">
                    <x-stat-card cardBg="bg-indigo-200" textColor="text-indigo-800" iconColor="bg-indigo-800"
                        :count="$stats['blotter_reports_pending']" label="BLOTTER">
                        <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Zm-4 1h.01v.01H15V5Zm-2 2h.01v.01H13V7Zm2 2h.01v.01H15V9Zm-2 2h.01v.01H13V11Zm2 2h.01v.01H15V13Zm-2 2h.01v.01H13V15Zm2 2h.01v.01H15V17Zm-2 2h.01v.01H13V19Z" />
                        </svg>
                    </x-stat-card>
                </a>

                <!-- Clearances -->
                <a href="{{ route('clearances.index') }}" style="text-decoration: none;">
                    <x-stat-card cardBg="bg-indigo-200" textColor="text-indigo-800" iconColor="bg-indigo-800"
                        :count="$stats['clearances_pending']" label="CLEARANCE">
                        <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M10 3v4a1 1 0 0 1-1 1H5m4 6 2 2 4-4m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                        </svg>
                    </x-stat-card>
                </a>

                <!--BUDGET SUMMARY-->
                <a href="{{ route('admin.budget.index') }}" style="text-decoration: none;">
                    <x-stat-card cardBg="bg-green-200 shadow-md" textColor="text-green-800" iconColor="bg-green-800"
                        :count="$budgetSummary['total_amount']" label="BUDGET">
                        <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2" />
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

        <div class="bg-neutral-50 shadow rounded-md p-4 mt-2 mb-3">
            <h5 class="font-semibold text-gray-700 mb-2 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v15a1 1 0 0 0 1 1h15M8 16l2.5-5.5 3 3L17.273 7 20 9.667" />
                </svg>
                Program Expenses
            </h5>
            <div id="financial-chart" data-categories='@json($financialData['categories'] ?? [])'
                data-budgetdata='@json($financialData['budgetData'] ?? [])'
                data-expensedata='@json($financialData['expenseData'] ?? [])'>
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