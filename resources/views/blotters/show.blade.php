<div class="row align-items-center mb-3">
    <p class="col fw-bold text-lg mb-0">BLOTTER ENTRY # {{ $blotter->display_id }}</p>
    <div class="col-auto">
        @auth
            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'staff')
                <a href="{{ route('blotter.pdf', $blotter->blotter_id) }}" target="_blank">
                    <x-primary-button class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] gap-1 text-base">
                        <i class="bi bi-printer"></i>Print PDF
                    </x-primary-button>
                </a>
            @endif
        @endauth
    </div>
</div>
<div>
    <table class="w-full border border-black text-sm">
        <tbody>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">COMPLAINANT</th>
                <td>{{ $blotter->resident->full_name }}</td>
            </tr>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">FULL ADDRESS</th>
                <td>{{ $blotter->resident->address }}</td>
            </tr>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">CONTACT</th>
                <td>{{ $blotter->resident->user->phone_number }}</td>
            </tr>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">TYPE OF INCIDENT</th>
                <td>{{ $blotter->incident_type }}</td>
            </tr>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">DATE AND TIME</th>
                <td>{{ $blotter->formatted_incident_date }} at {{ $blotter->formatted_incident_time }}</td>
            </tr>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">LOCATION</th>
                <td>{{ $blotter->location }}</td>
            </tr>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">DESCRIPTION</th>
                <td>{{ $blotter->description}}</td>
            </tr>
            <tr class="border-b border-gray-500 align-top">
                <th class="text-left font-semibold p-2">PROOF OF EVIDENCE</th>
                <td>@if($blotter->image && file_exists(public_path('uploads/blotters/' . $blotter->image)))
                    <img src="{{ asset('uploads/blotters/' . $blotter->image) }}" alt="Proof of Evidence"
                        class="img-fluid" style="max-width: 200px;">
                @else
                        <span class="text-muted">No image uploaded</span>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>