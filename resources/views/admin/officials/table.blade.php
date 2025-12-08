<table id="officialsTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
    hx-get="{{ route('admin.officials.index') }}" hx-trigger="refreshTable from:body" hx-target="this"
    hx-swap="innerHTML">
    <thead class="text-sm text-center text-gray-700 bg-slate-100 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-3 py-2">Official ID</th>
            <th scope="col" class="px-3 py-2">Full Name</th>
            <th scope="col" class="px-3 py-2">Position</th>
            <th scope="col" class="px-3 py-2">Term Start</th>
            <th scope="col" class="px-3 py-2">Term End</th>
            <th scope="col" class="px-3 py-2">Status</th>
            <th scope="col" class="px-3 py-2">Actions</th>
        </tr>
    </thead>
    <tbody class="text-center border border-gray-200 dark:border-gray-700 rounded-lg">
        @foreach($officials as $official)
            <tr
                class="bg-neutral-50 border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 divide-x divide-gray-100">
                <td class="px-3 py-2">
                    <a href="{{ route('admin.officials.show', $official->official_id) }}">
                        {{ $official->display_id }}
                    </a>
                </td>
                <th class="flex items-center px-2 py-2 text-gray-900 dark:text-white">
                    <img class="w-8 h-8 rounded-full"
                        src="{{ asset('storage/uploads/residents/' . $official->resident->profile->image) }}"
                        alt="{{ $official->resident->full_name }}" fetchpriority="high">
                    <div class="ps-2">
                        <div class="text-sm font-semibold">{{ $official->resident->full_name }}</div>
                    </div>
                </th>
                <td class="px-3 py-2">{{ $official->position }}</td>
                <td class="px-3 py-2">{{ $official->term_start->format('m/d/Y') }}</td>
                <td class="px-3 py-2">{{ $official->term_end ? $official->term_end->format('m/d/Y') : '-' }}</td>
                <td class="px-3 py-2">
                    @php
                        $statusColors = match ($official->status) {
                            'Active' => ['text' => 'text-green-500'],
                            'Inactive' => ['text' => 'text-red-500'],
                        };
                    @endphp

                    <span class="px-1.5 py-1 font-semibold text-sm {{ $statusColors['text'] }}">
                        {{ ucfirst($official->status) }}
                    </span>
                </td>
                <td class="px-3 py-2">
                    <x-primary-button hx-get="{{ route('admin.officials.edit', $official->official_id) }}"
                        hx-target="#editOfficialModalBody" hx-swap="innerHTML" data-bs-toggle="modal"
                        data-bs-target="#editOfficialModal"
                        class="!bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700 flex items-center justify-center">
                        <svg class="w-[15px] h-[15px] text-white dark:text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                        </svg>
                    </x-primary-button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>