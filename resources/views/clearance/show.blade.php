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