@section('title') {{ 'Residents List' }} @endsection


<x-app-layout>
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">
            <h5 class="text-base font-semibold mb-3 text-gray-500 dark:text-gray-100">Residents</h5>
            <div class="items-center justify-between gap-4 pb-4 bg-neutral-50 dark:bg-gray-900 shadow-md sm:rounded-lg">
                <!--SEARCH BAR-->
                <div class="flex justify-end p-3">
                    <x-input-label for="table-search" class="sr-only">Search</x-input-label>
                    <div class="relative">
                        <input type="text" id="table-search-users" name="search"
                            class="block pt-2 ps-3 text-sm text-gray-900 border border-gray-900 rounded-lg w-48 bg-gray-100 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search for users">
                    </div>
                </div>

                <!-- Residents Table -->
                <div class="overflow-y-auto overflow-x-auto h-64 border">
                    <table id="residents-table"
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-sm text-center text-gray-700 bg-slate-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-3 py-2">Resident ID</th>
                                <th scope="col" class="px-3 py-2">Full Name</th>
                                <th scope="col" class="px-3 py-2">Gender</th>
                                <th scope="col" class="px-3 py-2">Household Number</th>
                                <th scope="col" class="px-3 py-2">Date Registered</th>
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
                                            src="{{ asset('uploads/residents/' . $resident->profile->image) }}"
                                            alt="{{ $resident->full_name }}">
                                        <div class="ps-2">
                                            <div class="text-sm font-semibold">{{ $resident->full_name }}</div>
                                        </div>
                                    </th>
                                    <td class="px-3 py-2">{{ $resident->profile->gender }}</td>
                                    <td class="px-3 py-2">{{ $resident->household->household_number }}</td>
                                    <td class="px-3 py-2">{{ $resident->user->created_at->format('m/d/Y') }}</td>
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
                <div class="flex justify-center mt-3">
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