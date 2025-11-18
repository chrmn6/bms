<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
    <title>Barangay Clearance</title>
</head>

<body class="font-inter text-gray-900 p-8">
    <div class="header mb-4">
        <table class="w-full border-collapse">
            <tr>
                <td class="w-[100px] text-center">
                    <img src="{{ public_path('storage/images/bms-logo.png') }}" alt="Barangay Logo" width="60">
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
            <h2 class="mt-3 mb-3 text-xl font-bold">BARANGAY INDIGENCY</h2>
        </div>
    </div>

    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        This is to certify that <strong>{{ $resident->full_name }}</strong>, is a bonafide
        resident of Matina Gravahan, Davao City. This is to certify further
        that as per records, the above mentioned person is indigent.
    </p>

    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        This certification is being issued upon the request of the above named
        person to seek <strong>{{ $clearance->purpose }}</strong>.
    </p>

    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        Issued this <strong>{{ $clearance->issued_date->format('F d, Y') }}</strong> at the Office of the Barangay
        Matina Gravahan, Davao City.
    </p>

    <div class="mt-16 text-right">
        <p class="font-bold text-lg">HON. {{ $official->full_name }}</p>
        <p class="text-base">Barangay Captain</p>
    </div>
</body>

</html>