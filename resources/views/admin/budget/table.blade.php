<table id="financialTableContainer" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-sm text-center text-gray-700 bg-slate-100 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-3 py-2">Amount</th>
            <th scope="col" class="px-3 py-2">Description</th>
            <th scope="col" class="px-3 py-2">Date Added</th>
        </tr>
    </thead>
    <tbody class="text-center border border-gray-200 dark:border-gray-700 rounded-lg">
        @foreach($budgets as $budget)
            <tr
                class="bg-neutral-50 border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 divide-x divide-gray-100">
                <td class="px-3 py-2">{{ number_format($budget->amount, 2) }}</td>
                <td class="px-3 py-2">{{ $budget->description }}</td>
                <td class="px-3 py-2">{{ $budget->created_at->format('m/d/Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>