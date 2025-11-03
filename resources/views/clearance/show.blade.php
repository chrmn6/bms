<div class="row align-items-center mb-3">
    <p class="col fw-bold text-lg mb-0">CLEARANCE # {{ $clearance->display_id }}</p>
    <div class="col-auto">
        @auth
            @if (auth()->user()->role === 'resident' || auth()->user()->role === 'staff')
                @if($clearance->status === 'released')
                    <a href="{{ route('clearances.pdf', $clearance->clearance_id) }}">
                        <x-primary-button class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] gap-1 text-base">
                            <i class="bi bi-printer"></i>Print PDF
                        </x-primary-button>
                    </a>
                @endif
            @endif
        @endauth
    </div>
</div>
<div>
    <table class="w-full border border-black text-sm">
        <tbody>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">REQUESTED BY</th>
                <td>{{ $clearance->resident->full_name }}</td>
            </tr>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">CLEARANCE TYPE</th>
                <td>{{ $clearance->clearance_type }}</td>
            </tr>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">PURPOSE</th>
                <td>{{ $clearance->purpose }}</td>
            </tr>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">ISSUED DATE</th>
                <td>{{ $clearance->issued_date ?? '-' }}</td>
            </tr>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">VALID UNTIL</th>
                <td>{{ $clearance->valid_until ?? '-' }}</td>
            </tr>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">REMARKS</th>
                <td>{{ $clearance->remarks }}</td>
            </tr>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">PROCESSED BY</th>
                <td>{{ $clearance->user?->full_name ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>
</div>