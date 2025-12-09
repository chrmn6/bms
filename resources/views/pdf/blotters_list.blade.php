<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
    <title>Blotter Report Transcript</title>
</head>

<body class="font-inter text-gray-900 p-8">
    <div class="header mb-4">
        <table class="w-full border-collapse">
            <tr>
                <td class="w-[100px] text-center">
                    <img src="{{ public_path('storage/images/bms-logo.png') }}" alt="Barangay Logo" width="60"
                        fetchpriority="high">
                </td>
                <td class="text-center">
                    <h1 class="m-0 text-base font-normal">Republic of the Philippines</h1>
                    <h1 class="m-0 text-base font-normal">Region XI</h1>
                    <h2 class="m-0 text-base font-normal">BARANGAY MATINA GRAVAHAN</h2>
                    <h3 class="m-0 text-base font-normal">City of Davao</h3>
                </td>
                <td style="width: 100px;"></td>
            </tr>
        </table>
        <div class="mt-3 text-center">
            <h3 class="mb-2 text-sm font-semibold">OFFICE OF THE PUNONG BARANGAY</h3>
            <hr class="mb-3 border-t-6 border-black shadow-lg">
            <h2 class="mt-3 mb-3 text-xl font-bold">BLOTTER REPORTS</h2>
        </div>
    </div>

    <table class="w-full text-sm text-left rtl:text-right text-black">
        <thead class="text-base text-center text-gray-700 bg-white border border-black">
            <tr>
                <th>Case No.</th>
                <th>Title</th>
                <th>Status</th>
                <th>Filed By</th>
                <th>Date Filed</th>
            </tr>
        </thead>
        <tbody class="text-center border border-black">
            @foreach($blotters as $blotter)
                <tr>
                    <td>
                        <a href="{{ route('blotter.pdf', $blotter->blotter_id) }}">
                            {{ $blotter->display_id }}
                        </a>
                    </td>
                    <td>{{ $blotter->case->incident_type }}</td>
                    <td>{{ ucfirst($blotter->status) }}</td>
                    <td>{{ $blotter->resident->full_name ?? 'N/A' }}</td>
                    <td>{{ $blotter->created_at->format('F d, Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>