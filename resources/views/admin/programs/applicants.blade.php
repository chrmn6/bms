@section('title', 'Applicants')

<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="py-3">
            <h5 class="text-base font-semibold mb-3 text-gray-500 dark:text-gray-100">Applicants</h5>
            <div class="items-center justify-between gap-4 pb-4 bg-neutral-50 dark:bg-gray-900 shadow-md sm:rounded-lg">
                <div class="flex justify-between items-center p-3 flex-wrap sm:flex-nowrap">
                    <div class="flex flex-wrap gap-1 mb-1">
                        <a href="{{ route('admin.programs.index') }}" class="btn btn-white border btn-sm">
                            <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                            </svg>
                        </a>
                    </div>
                </div>

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-sm text-center text-gray-700 bg-slate-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-3 py-2">Application No.</th>
                            <th scope="col" class="px-3 py-2">Resident</th>
                            <th scope="col" class="px-3 py-2">Status</th>
                            <th scope="col" class="px-3 py-2">Submitted Date</th>
                            <th scope="col" class="px-3 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center border border-gray-200 dark:border-gray-700 rounded-lg overflow-y-auto">
                        @foreach ($applicants as $a)
                            <tr
                                class="bg-neutral-50 border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 divide-x divide-gray-100">
                                <td class="px-3 py-2">
                                    <p class="text-sm text-blue-600 dark:text-blue-400 m-0">
                                        {{ $a->display_id }}
                                    </p>
                                </td>
                                <td class="px-3 py-2">
                                    {{ $a->resident->full_name }}
                                </td>
                                <td class="px-3 py-2">
                                    @php
                                        $statusColors = match ($a->status) {
                                            'Approved' => ['text' => 'text-green-500'],
                                            'Rejected' => ['text' => 'text-red-500'],
                                            'Pending' => ['text' => 'text-yellow-500'],
                                            default => ['text' => 'text-gray-500']
                                        };
                                    @endphp

                                    <span class="px-1.5 py-1 font-semibold text-sm {{ $statusColors['text'] }}">
                                        {{ ucfirst($a->status) }}
                                    </span>
                                </td>
                                <td class="px-3 py-2">{{ $a->created_at->format('Y-m-d') }}</td>
                                <td class="px-3 py-2">
                                    <x-primary-button hx-get="{{ route('admin.programs.show', $a->id) }}"
                                        hx-target="#viewProgramModalBody" hx-swap="innerHTML" hx-trigger="click"
                                        data-bs-toggle="modal" data-bs-target="#viewProgramModal"
                                        class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700 flex items-center justify-center">
                                        <svg class="w-[15px] h-[15px] text-white dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                            <path stroke="currentColor" stroke-width="1.2"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </x-primary-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewProgramModal" tabindex="-1" aria-labelledby="viewProgramModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-m modal-dialog-centered">
            <div class="bg-[#FAFAFA] modal-content border-0 shadow-lg">
                <div class="modal-header !bg-[#6D0512] text-white py-2">
                    <h5 class="modal-title" id="viewBlotterModalLabel">
                        Application Form
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="viewProgramModalBody">
                    <div class="text-center py-5 text-muted">
                        <div class="spinner-border text-primary mb-3" role="status"></div>
                        <p>Loading application details...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>