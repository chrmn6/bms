<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
    <title>Certificate of Residency</title>
</head>

<body class="font-inter text-gray-900 p-8">

    <div class="header mb-4">
        <table class="w-full border-collapse">
            <tr>
                <td class="w-[100px] text-center">
                    <img src="{{ public_path('images/bms-logo.png') }}" alt="Barangay Logo" width="60">
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
            <h2 class="mt-3 mb-3 text-xl font-bold">CERTIFICATE OF RESIDENCY</h2>
        </div>
    </div>

    <p class="font-bold mb-4">TO WHOM IT MAY CONCERN:</p>
    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        This is to certify that <strong>{{ $resident->full_name }}</strong>, of legal age,
        {{ $resident_profile->civil_status }}, {{ $resident_profile->citizenship }} citizen,
        whose specimen signature appears below, is a <strong>PERMANENT RESIDENT</strong>
        of this Barangay Matina Gravahan, Davao City, Philippines.
    </p>

    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        Based on records of this office, he/she has been residing at
        <strong>{{ $resident->full_address }}</strong>.
    </p>

    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        This <strong>CERTIFICATION</strong> is being issued upon the request of the
        above-named person for whatever legal purpose it may serve.
    </p>

    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        Issued this <strong>{{ $clearance->issued_date }}</strong> at Barangay Matina Gravahan, Davao City,
        Philippines.
    </p>

    <div class="mt-16 text-right">
        <p class="font-bold text-lg">JOHN DOE</p>
        <p class="text-base">Punong Barangay</p>
    </div>
</body>

</html>