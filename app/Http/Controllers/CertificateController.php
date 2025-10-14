<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Resident;
use App\Models\ResidentProfile;
use App\Models\Clearance;
use App\Models\Household;

class CertificateController extends Controller
{
    public function barangayClearance($resident_id)
    {
        $resident = Resident::findOrFail($resident_id);
        $household = Household::find($resident->household_number);
        $clearance = Clearance::where('resident_id', $resident_id)->latest()->first();

        $data = [
            'resident' => $resident,
            'clearance' => $clearance,
            'issued_date' => $clearance->issued_date,
            'household_number' => $resident->household_number,
            'household' => $household,
            'barangay_name' => 'Barangay Matina Gravahan',
            'city_name' => 'Davao City',
            'barangay_captain' => 'John Doe',
        ];

        $pdf = Pdf::loadView('pdf.barangay_clearance', $data)->setPaper('A4', 'portrait');

        return $pdf->download("BarangayClearance_{$resident->full_name}.pdf");
    }

    public function businessClearance($resident_id)
    {
        $resident = Resident::findOrFail($resident_id);
        $household = Household::find($resident->household_number);
        $clearance = Clearance::where('resident_id', $resident_id)->latest()->first();

        $data = [
            'resident' => $resident,
            'resident_address' => $resident->address,
            'clearance' => $clearance,
            'issued_date' => $clearance->issued_date,
            'valid_until' => $clearance->valid_until,
            'household_number' => $resident->household_number,
            'household' => $household,
            'barangay_name' => 'Barangay Matina Gravahan',
            'city_name' => 'Davao City',
            'barangay_captain' => 'John Doe',
        ];

        $pdf = Pdf::loadView('pdf.business_clearance', $data)->setPaper('A4', 'portrait');

        return $pdf->download("BusinessClearance_{$resident->full_name}.pdf");
    }

    public function residencyClearance($resident_id)
    {
        $resident = Resident::findOrFail($resident_id);
        $household = Household::find($resident->household_number);
        $clearance = Clearance::where('resident_id', $resident_id)->latest()->first();

        $data = [
            'resident' => $resident,
            'resident_address' => $resident->address,
            'household_number' => $resident->household_number,
            'resident_profile' => $resident->profile,
            'clearance' => $clearance,
            'household' => $household,
            'issued_date' => $clearance->issued_date,
            'barangay_name' => 'Barangay Matina Gravahan',
            'city_name' => 'Davao City',
            'barangay_captain' => 'John Doe',
        ];

        $pdf = Pdf::loadView('pdf.residency_clearance', $data)->setPaper('A4', 'portrait');

        return $pdf->download("ResidencyClearance_{$resident->full_name}.pdf");
    }
}