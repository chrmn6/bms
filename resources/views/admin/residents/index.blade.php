@section('title') {{ 'Residents List' }} @endsection

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">
            <h5 class="text-base font-semibold mb-3 text-gray-500 dark:text-gray-100">Residents</h5>
            <div class="items-center justify-between gap-4 pb-4 bg-neutral-50 dark:bg-gray-900 shadow-md sm:rounded-lg">
                <div class="flex items-center justify-between p-3">
                    <!--PHASE FILTER--->
                    <div>
                        <form method="GET" class="flex items-center gap-3">
                            <select id="phase-filter" name="phase_filter"
                                class="block pt-2 ps-3 text-sm text-gray-900 border border-gray-900 rounded-lg w-38 bg-neutral-50"
                                onchange="this.form.submit()">
                                <option value="">All Phases</option>
                                @foreach($phases as $phase)
                                <option value="{{ $phase->phase_id }}" {{request('phase_filter')==$phase->phase_id
                                    ?'selected' :
                                    '' }}>
                                    {{ $phase->phase_number }}
                                </option>
                                @endforeach
                            </select>

                            <!--HOUSEHOLD FILTER--->
                            <select id="household-filter" name="household_filter"
                                class="block pt-2 ps-3 text-sm text-gray-900 border border-gray-900 rounded-lg w-38 bg-neutral-50"
                                onchange="this.form.submit()">
                                <option value="">All Households</option>
                                @foreach($households as $household)
                                <option value="{{ $household->household_id }}"
                                    {{request('household_filter')==$household->household_id ?'selected' : '' }}>
                                    {{ $household->household_number }}
                                </option>
                                @endforeach
                            </select>

                            <!--GENDER FILTER--->
                            <select id="gender-filter" name="gender"
                                class="block pt-2 ps-3 text-sm text-gray-900 border border-gray-900 rounded-lg w-32 bg-neutral-50"
                                onchange="this.form.submit()">
                                <option value="">All Genders</option>
                                <option value="Male" {{ request('gender')=='Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ request('gender')=='Female' ? 'selected' : '' }}>Female
                                </option>
                            </select>

                            <!-- STATUS FILTER -->
                            <select id="status-filter" name="status"
                                class="block pt-2 ps-3 text-sm text-gray-900 border border-gray-900 rounded-lg w-32 bg-neutral-50"
                                onchange="this.form.submit()">
                                <option value="">All Statuses</option>
                                <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </form>
                    </div>

                    <!--SEARCH BAR-->
                    <x-input-label for="table-search" class="sr-only">Search</x-input-label>
                    <div class="relative">
                        <input type="text" id="table-search-users" name="search"
                            class="block pt-2 ps-3 text-sm text-gray-900 border border-gray-900 rounded-lg w-38 bg-neutral-50"
                            placeholder="Search for users">
                    </div>
                </div>

                <!-- Residents Table -->
                <div class="overflow-y-auto overflow-x-auto h-80 border">
                    <table id="residents-table"
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-sm text-center text-gray-700 bg-slate-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-3 py-2">Resident ID</th>
                                <th scope="col" class="px-3 py-2">Full Name</th>
                                <th scope="col" class="px-3 py-2">Gender</th>
                                <th scope="col" class="px-3 py-2">Phase Number</th>
                                <th scope="col" class="px-3 py-2">Household Number</th>
                                <th scope="col" class="px-3 py-2">Date Registered</th>
                                <th scope="col" class="px-3 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="border border-gray-200 dark:border-gray-700 rounded-lg">
                            @forelse($residents as $resident)
                                <tr
                                    class="bg-neutral-50 text-center border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 divide-x divide-gray-100">
                                    <td class="px-3 py-2">
                                        <a href="{{ route('admin.resident.show', $resident->resident_id) }}">
                                            {{ $resident->display_id }}
                                        </a>
                                    </td>
                                    <th class="flex items-center px-2 py-2 text-gray-900 dark:text-white">
                                        <img class="w-8 h-8 rounded-full"
                                            src="{{ asset('storage/uploads/residents/' . $resident->profile->image) }}"
                                            alt="{{ $resident->full_name }}">
                                        <div class="ps-2">
                                            <div class="text-sm font-semibold">{{ $resident->full_name }}</div>
                                        </div>
                                    </th>
                                    <td class="px-3 py-2">{{ $resident->profile->gender }}</td>
                                    <td class="px-3 py-2">{{ $resident->phase->phase_number }}</td>
                                    <td class="px-3 py-2">{{ $resident->household->household_number }}</td>
                                    <td class="px-3 py-2">{{ $resident->user->created_at->format('m/d/Y') }}</td>
                                    <td class="px-3 py-2">
                                        @if($resident->user->status === 'Active')
                                            <span class="text-green-700 font-semibold text-sm">Active</span>
                                        @elseif($resident->user->status === 'Inactive')
                                            <span class="text-red-700 font-semibold text-sm">Inactive</span>
                                        @else
                                            <div class="flex gap-1 justify-center">
                                                <form action="{{ route('admin.resident.approve', $resident->resident_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <x-primary-button type="submit"
                                                        class="!bg-green-600 rounded text-xs hover:bg-green-700">
                                                        <svg class="w-4 h-4 text-white dark:text-white" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="1.9"
                                                                d="M5 11.917 9.724 16.5 19 7.5" />
                                                        </svg>
                                                    </x-primary-button>
                                                </form>

                                                <form action="{{ route('admin.resident.reject', $resident->resident_id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to reject this resident?');">
                                                    @csrf
                                                    @method('POST')
                                                    <x-primary-button type="submit"
                                                        class="!bg-red-600 rounded text-xs hover:bg-red-700">
                                                        <svg class="w-4 h-4 text-white dark:text-white" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="1.9"
                                                                d="M6 18 17.94 6M18 18 6.06 6" />
                                                        </svg>
                                                    </x-primary-button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="bi bi-people"></i>
                                        <p class="mb-0">No residents found.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3 px-4">
                    {{ $residents->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('table-search-users');
            const table = document.getElementById('residents-table');
            const rows = table.querySelectorAll('tbody tr');

            searchInput.addEventListener('keyup', () => {
                const query = searchInput.value.toLowerCase();

                rows.forEach(row => {
                    const rowText = row.innerText.toLowerCase();
                    row.style.display = rowText.includes(query) ? '' : 'none';
                });
            });
        });
    </script>
</x-app-layout>