<table id="financialTableContainer" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-sm text-center text-gray-700 bg-slate-100 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-3 py-2">Amount</th>
            <th scope="col" class="px-3 py-2">Description</th>
            <th scope="col" class="px-3 py-2">Date Added</th>
            <th scope="col" class="px-3 py-2">Action</th>
        </tr>
    </thead>
    <tbody class="text-center border border-gray-200 dark:border-gray-700 rounded-lg">
        @foreach($budgets as $budget)
            <tr
                class="bg-neutral-50 border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 divide-x divide-gray-100">
                <td class="px-3 py-2">{{ number_format($budget->amount, 2) }}</td>
                <td class="px-3 py-2">{{ $budget->description }}</td>
                <td class="px-3 py-2">{{ $budget->created_at->format('m/d/Y') }}</td>
                <td class="px-3 py-2">
                    <x-primary-button hx-get="{{ route('admin.budget.edit', $budget->budget_id) }}"
                        hx-target="#editBudgetModalBody" hx-swap="innerHTML" data-bs-toggle="modal"
                        data-bs-target="#editBudgetModal"
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