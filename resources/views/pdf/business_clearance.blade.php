<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
    <title>Business Clearance</title>
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
            <h2 class="mt-3 mb-3 text-xl font-bold">BARANGAY BUSINESS CLEARANCE</h2>
        </div>
    </div>

    <p class="font-bold mb-4">TO WHOM IT MAY CONCERN:</p>
    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        Pursuant to existing ordinance of this barangay, CLEARANCE is granted to
        <strong>{{ $resident->full_name }}</strong> and owner of
        <strong>{{ $resident->full_name }}</strong> located at {{ $resident->full_address }}.
    </p>

    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        Applicant is hereby advised to follow strictly existing ordinance in relation with
        the conduct of his/her business. Violation of the same is a ground for the revocation
        of this clearance.
    </p>

    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        Clearance is valid up to {{ $clearance->valid_until->format('F d, Y') }} unless revoked due to a valid cause.
        Issued this {{ $clearance->issued_date->format('F d, Y') }} at Barangay Matina Gravahan, Davao City,
        Philippines.
    </p>

    <div class="mt-16 text-right">
        <p class="font-bold text-lg">HON. {{ $official->resident->full_name }}</p>
        <p class="text-base">Barangay Captain</p>
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