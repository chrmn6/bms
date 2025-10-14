<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
    <title>Business Clearance</title>
</head>

<body class="font-inter text-gray-900 p-8">

    <div class="text-center mb-4">
        <h1 class="text-medium">Republic of the Philippines</h1>
        <h2 class="text-xl font-semibold">BARANGAY MATINA GRAVAHAN</h2>
        <h3 class="text-base">City of Davao</h3>
        <h2 class="text-2xl font-bold mb-8 mt-8">BARANGAY BUSINESS CLEARANCE</h2>
    </div>

    <p class="font-bold mb-4">TO WHOM IT MAY CONCERN:</p>
    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        Pursuant to existing ordinance of this barangay, CLEARANCE is granted to
        <strong>{{ $resident->full_name }}</strong> And owner of
        <strong>{{ $resident->full_name }}</strong> located at {{ $resident->household->household_number }},
        {{ $resident->address }}.
    </p>

    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        Applicant is hereby advised to follow strictly existing ordinance in relation with
        the conduct of his/her business. Violation of the same is a ground for the revocation
        of this clearance.
    </p>

    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        Clearance is valid up to {{ $clearance->valid_until }} unless revoked due to a valid cause.
        Issued this {{ $clearance->issued_date }} at Barangay Matina Gravahan, Davao City, Philippines.
    </p>

    <div class="mt-16 text-right">
        <p class="font-bold text-lg">JOHN DOE</p>
        <p class="text-base">Punong Barangay</p>
    </div>

    <p class="text-center mt-16 text-xs">
        "TO BE POSTED INSIDE THE PREMISES OF THE BUSINESS ESTABLISHMENT"
    </p>

    <div class="text-center text-xs font-semibold mt-2">
        <p>IMPORTANT</p>
        <p>This Barangay Clearance is not valid without official seal.</p>
        <p>Any erasure and alteration invalidates the same.</p>
    </div>
</body>

</html>