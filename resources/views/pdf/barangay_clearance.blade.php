<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
    <title>Barangay Clearance</title>
</head>

<body class="font-inter text-gray-900 p-8">

    <div class="text-center mb-4">
        <h1 class="text-medium">Republic of the Philippines</h1>
        <h2 class="text-xl font-semibold">BARANGAY MATINA GRAVAHAN</h2>
        <h3 class="text-base">City of Davao</h3>
        <h2 class="text-2xl font-bold mb-8 mt-8">BARANGAY CLEARANCE</h2>
    </div>

    <p class="font-bold mb-4">TO WHOM IT MAY CONCERN:</p>
    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        This is to certify that <strong>{{ $resident->full_name }}</strong> with residence and postal
        address at {{ $resident->household->household_number }}, {{ $resident->address }}, Barangay Matina Gravahan,
        Davao City has no derogatory record filed in our Barangay Office.
    </p>

    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        The above-named individual who is a bonafide resident of this barangay is a
        person of good moral character, peace-loving and civic minded citizen.
    </p>

    <p class="text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        This certification is hereby issued in connection with the subject's application for
        <strong>{{ $clearance->purpose }}</strong> and for whatever legal purpose it
        may serve him/her best, and is valid for six (6) months from the date issued.
    </p>

    <p class="font-bold text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        NOT VALID WITHOUT OFFICIAL SEAL.
    </p>

    <p class="font-bold text-justify leading-relaxed mb-8" style="text-indent: 2em;">
        Given this {{ $clearance->issued_date }}.
    </p>

    <div class="mt-16 text-right">
        <p class="font-bold text-lg">JOHN DOE</p>
        <p class="text-base">Punong Barangay</p>
    </div>
</body>

</html>