<div class="row align-items-center mb-3">
    <p class="col fw-bold text-lg mb-0">CLEARANCE # {{ $clearance->display_id }}</p>
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
            <tr class="border-b border-gray-500 align-top">
                <th class="text-left font-semibold p-2">PAYMENT PROOF</th>
                <td>@if($clearance->payment_proof && file_exists(public_path('storage/uploads/proofs/' . $clearance->payment_proof)))
                    <img src="{{ asset('storage/uploads/proofs/' . $clearance->payment_proof) }}" alt="Payment Proof"
                        class="img-fluid" style="max-width: 200px;" fetchpriority="high">
                @else
                        <span class="text-muted">No image uploaded</span>
                    @endif
                </td>
            </tr>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">ISSUED DATE</th>
                <td>{{ optional($clearance->issued_date)->format('F j, Y') ?? '-' }}</td>
            </tr>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">VALID UNTIL</th>
                <td>{{ optional($clearance->valid_until)->format('F j, Y') ?? '-' }}</td>
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