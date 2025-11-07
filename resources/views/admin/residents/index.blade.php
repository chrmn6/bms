@section('title') {{ 'Residents List' }} @endsection


<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Residents List
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div
                    class="flex items-center justify-between flex-column flex-wrap md:flex-row gap-4 py-4 pb-4 p-4 bg-[#FAFAFA] dark:bg-gray-900">
                    <!--SEARCH BAR-->
                    <h4>search bar</h4>

                    <!-- Residents Table -->
                    <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-400">
                        <thead class="text-xs text-white uppercase bg-[#6D0512] dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-3 py-2">Resident ID</th>
                                <th scope="col" class="px-6 py-2">Full Name</th>
                                <th scope="col" class="px-2 py-2">Household Number</th>
                                <th scope="col" class="px-2 py-2">Phone Number</th>
                                <th scope="col" class="px-2 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($residents as $resident)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-3 py-2">
                                        <div class="flex items-center">
                                            {{ $resident->display_id }}
                                        </div>
                                    </td>
                                    <td class="flex items-center px-3 py-2 text-gray-900 dark:text-white">
                                        <img class="w-10 h-10 rounded-full"
                                            src="{{ asset('uploads/residents/' . $resident->profile->image) }}"
                                            alt="{{ $resident->full_name }}">
                                        <div class="ps-3">
                                            <div class="text-sm font-semibold">{{ $resident->full_name }}</div>
                                            <div class="font-normal text-gray-500">{{ $resident->user->email }}</div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-2">{{ $resident->household->household_number }}</td>
                                    <td class="px-3 py-2">{{ $resident->user->phone_number }}</td>
                                    <td class="px-3 py-2">
                                        <x-primary-button
                                            hx-get="{{ route('admin.resident.show', $resident->resident_id) }}"
                                            hx-target="#viewResidentModalBody" hx-swap="innerHTML" hx-trigger="click"
                                            data-bs-toggle="modal" data-bs-target="#viewResidentModal"
                                            aria-label="View resident details"
                                            class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700 flex items-center justify-center">
                                            <svg class="w-[20px] h-[20px] text-white dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-width="2"
                                                    d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                <path stroke="currentColor" stroke-width="2"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </x-primary-button>
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

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $residents->links() }}
                    </div>

                    <!-- View Resident Modal -->
                    <div class="modal fade" id="viewResidentModal" tabindex="-1"
                        aria-labelledby="viewResidentModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg">
                                <div class="modal-header !bg-[#6D0512] text-white">
                                    <h5 class="modal-title" id="viewResidentModalLabel">
                                        <i class="bi bi-person-circle me-2"></i> Resident Details
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body" id="viewResidentModalBody">
                                    <div class="text-center py-5 text-muted">
                                        <div class="spinner-border text-primary mb-3" role="status"></div>
                                        <p>Loading resident details...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>