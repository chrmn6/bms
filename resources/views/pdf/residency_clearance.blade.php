<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
    <title>Certificate of Residency</title>
</head>

<body class="font-inter text-gray-900 p-8">

    <div class="text-center mb-4">
        <h1 class="text-medium">Republic of the Philippines</h1>
        <h2 class="text-xl font-semibold">BARANGAY MATINA GRAVAHAN</h2>
        <h3 class="text-base">City of Davao</h3>
        <h2 class="text-2xl font-bold mb-8 mt-8">CERTIFICATE OF RESIDENCY</h2>
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
        <strong>{{ $resident->household->household_number }}, {{ $resident->address }}</strong>.
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