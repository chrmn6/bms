<!DOCTYPE html>
<html lang="en">

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
            <h2 class="mt-3 mb-3 text-xl font-bold">BLOTTER REPORT</h2>
        </div>
    </div>

    <p><span class="font-semibold">Blotter No.:</span> {{ $blotter->display_id }}</p>
    <p><span class="font-semibold">Date Reported:</span> {{ $blotter->created_at->format('F d, Y h:i A') }}
    </p>

    <div class="mt-3 space-y-1 mb-8">
        <p><span class="font-semibold text-base">Complainant:</span> {{ $blotter->resident->full_name}}</p>
        <p><span class="font-semibold text-base">Respondent:</span> {{ $blotter->respondent_name}}</p>
        <p><span class="font-semibold text-base">Address:</span> {{ $blotter->resident->full_address }}</p>
        <p><span class="font-semibold text-base">Contact:</span> {{ $blotter->resident->user->phone_number }}</p>
    </div>

    <p class="text-justify leading-relaxed mt-3 mb-8" style="text-indent: 2em;">
        On {{ $blotter->case->formatted_incident_date }}, at around {{ $blotter->case->formatted_incident_time }},
        a {{ strtolower($blotter->case->incident_type) }} was reported by
        {{ $blotter->resident->full_name }} at {{ $blotter->case->location }}.
        According to the complainant, {{ strtolower($blotter->case->description) }}.
    </p>


    <table class="w-full border-collapse mt-12">
        <td class="text-left">
            <div class="text-center">
                <p>Reported by:</p>
                <p><strong>{{ $blotter->resident->full_name }}</strong><br>Complainant</p>
            </div>
        </td>
        <td class="text-right">
            <div class="text-center">
                <p>Recorded by:</p>
                <p><strong>{{ $blotter->user?->full_name ?? 'N/A' }}</strong><br>Barangay Secretary</p>
            </div>
        </td>
    </table>

</body>

</html>