<table id="officialsTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
    hx-get="{{ route('admin.officials.index') }}" hx-trigger="refreshTable from:body" hx-target="this"
    hx-swap="innerHTML">
    <thead class="text-sm text-center text-gray-700 bg-slate-50 dark:bg-gray-700 dark:text-gray-400">
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
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 divide-x divide-gray-100">
                <td class="px-3 py-2">
                    {{ $official->display_id }}
                </td>
                <td class="px-3 py-2">{{ $official->full_name }}</td>
                <td class="px-3 py-2">{{ $official->position }}</td>
                <td class="px-3 py-2">{{ $official->term_start->format('m/d/Y') }}</td>
                <td class="px-3 py-2">{{ $official->term_end->format('m/d/Y') }}</td>
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
                    <x-primary-button hx-get="{{ route('admin.officials.show', $official->official_id) }}"
                        hx-target="#viewOfficialModalBody" hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal"
                        data-bs-target="#viewOfficialModal"
                        class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700 flex items-center justify-center">
                        <i class="bi bi-eye text-xs"></i>
                    </x-primary-button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>