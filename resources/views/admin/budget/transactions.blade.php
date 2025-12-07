<div class="overflow-y-auto max-h-64">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-sm text-center text-gray-700 bg-slate-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3">Date</th>
                <th scope="col" class="px-4 py-3">Program</th>
                <th scope="col" class="px-4 py-3">Program Organizer</th>
                <th scope="col" class="px-4 py-3">Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse($expenses as $expense)
                <tr
                    class="bg-neutral-50 text-center border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 divide-x divide-gray-100">
                    <td class="px-4 py-3">{{ $expense->created_at->format('m/d/Y h:i A') }}</td>
                    <td class="px-4 py-3">{{ $expense->program->title ?? 'N/A' }}</td>
                    <td class="px-4 py-3">
                        {{ $expense->official->resident->full_name ?? 'N/A' }}
                    </td>
                    <td class="px-4 py-3 text-red-600 font-semibold">
                        ₱{{ number_format($expense->amount, 2) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                        No transactions yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Summary -->
<div class="mt-4 p-4 bg-slate-100 dark:bg-gray-700 rounded-lg space-y-2">
    <div class="flex justify-between items-center">
        <span class="text-gray-700 dark:text-gray-300">Total Budget:</span>
        <span class="font-semibold text-gray-900 dark:text-white">
            ₱{{ number_format($totalBudget, 2) }}
        </span>
    </div>
    <div class="flex justify-between items-center">
        <span class="text-gray-700 dark:text-gray-300">Total Expenses:</span>
        <span class="font-semibold text-red-600">
            ₱{{ number_format($totalExpenses, 2) }}
        </span>
    </div>
    <div class="flex justify-between items-center pt-2 border-t border-gray-300 dark:border-gray-600">
        <span class="font-bold text-gray-900 dark:text-white">Remaining Budget:</span>
        <span class="text-lg font-bold {{ $remainingBudget >= 0 ? 'text-green-600' : 'text-red-600' }}">
            ₱{{ number_format($remainingBudget, 2) }}
        </span>
    </div>
</div>