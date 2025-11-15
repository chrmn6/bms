@section('title', 'Applicants')

<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="py-3">
            <h5 class="text-base font-semibold mb-3 text-gray-500 dark:text-gray-100">Applicants</h5>
            <div class="items-center justify-between gap-4 pb-4 bg-neutral-50 dark:bg-gray-900 shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-sm text-center text-gray-700 bg-slate-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-3 py-2">Application #</th>
                            <th scope="col" class="px-3 py-2">Resident</th>
                            <th scope="col" class="px-3 py-2">Status</th>
                            <th scope="col" class="px-3 py-2">Submitted</th>
                            <th scope="col" class="px-3 py-2">Proof</th>
                            <th scope="col" class="px-3 py-2">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="text-center border border-gray-200 dark:border-gray-700 rounded-lg overflow-y-auto">
                        @foreach ($applicants as $a)
                            <tr
                                class="bg-neutral-50 border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 divide-x divide-gray-100">
                                <td class="px-3 py-2">
                                    <a href="{{ route('admin.programs.index') }}">
                                        {{ $a->display_id }}
                                    </a>
                                </td>
                                <td class="px-3 py-2">
                                    {{ $a->resident->full_name }}
                                </td>
                                <td class="px-3 py-2">{{ $a->status }}</td>
                                <td class="px-3 py-2">{{ $a->created_at->format('Y-m-d') }}</td>
                                <td class="px-3 py-2">@if($a->proof_file)
                                    <a href="{{ asset('storage/' . $a->proof_file) }}" target="_blank">View</a>
                                @endif
                                </td>
                                <td class="px-3 py-2">
                                    @if($a->status === 'Pending')
                                        <a href="{{ route('admin.programs.approve', $a->id) }}"
                                            class="btn btn-success btn-sm">Approve</a>
                                        <a href="{{ route('admin.programs.reject', $a->id) }}"
                                            class="btn btn-danger btn-sm">Reject</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>