<?php

namespace App\Exports;

use App\Models\PostPupillage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping; // For custom mapping
use Maatwebsite\Excel\Concerns\WithHeadings; // For headings

class PostPupillageExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return PostPupillage::all();
    }

    public function map($application): array
    {
        return [
            $application->user_id,
            $application->vacancy_no,
            $application->full_name,
            $application->date_of_birth,
            $application->identity_card_number,
            $application->gender,
            $application->kra_pin,
            $application->nhif_card_number,
            $application->postal_address,
            $application->postal_code,
            $application->town,
            $application->email_address,
            $application->mobile_number,
            $application->home_county,
            $application->sub_county,
            $application->ethnicity,
            $application->disability_status,
            $application->nature_of_disability,
            $application->qualifications,
            $application->deployment_region,
            $application->declaration,
            $application->status,
            $application->remarks,
        ];
    }

    public function headings(): array
    {
        return [
            'User ID',
            'Vacancy No',
            'Full Name',
            'Date of Birth',
            'Identity Card Number',
            'Gender',
            'KRA PIN',
            'NHIF Card Number',
            'Postal Address',
            'Postal Code',
            'Town',
            'Email Address',
            'Mobile Number',
            'Home County',
            'Sub County',
            'Ethnicity',
            'Disability Status',
            'Nature of Disability',
            'Qualifications',
            'Deployment Region',
            'Declaration',
            'Status',
            'Remarks',
        ];
    }
}
