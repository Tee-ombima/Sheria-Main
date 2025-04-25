<?php

namespace App\Exports;

use App\Models\Pupillage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping; // For custom mapping
use Maatwebsite\Excel\Concerns\WithHeadings; // For headings

class PupillageExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Pupillage::all();
    }

    public function map($application): array
    {
        return [
            $application->user_id,
            $application->full_name,
            $application->date_of_birth,
            $application->identity_card_number,
            $application->gender,
            $application->nationality,
            $application->ethnicity,
            $application->home_county,
            $application->sub_county,
            $application->disability_status,
            $application->nature_of_disability,
            $application->postal_address,
            $application->postal_code,
            $application->town,
            $application->physical_address,
            $application->mobile_number,
            $application->alternate_mobile_number,
            $application->email_address,
            $application->ksce_grade,
            $application->institution_name,
            $application->institution_grade,
            $application->declaration,
            $application->status,
        ];
    }

    public function headings(): array
    {
        return [
            'User ID',
            'Full Name',
            'Date of Birth',
            'Identity Card Number',
            'Gender',
            'Nationality',
            'Ethnicity',
            'Home County',
            'Sub County',
            'Disability Status',
            'Nature of Disability',
            'Postal Address',
            'Postal Code',
            'Town',
            'Physical Address',
            'Mobile Number',
            'Alternate Mobile Number',
            'Email Address',
            'KSCE Grade',
            'Institution Name',
            'Institution Grade',
            'Declaration',
            'Status',
        ];
    }
}
