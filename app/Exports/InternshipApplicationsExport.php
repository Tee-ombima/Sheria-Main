<?php

namespace App\Exports;

use App\Models\InternshipApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping; // For custom mapping
use Maatwebsite\Excel\Concerns\WithHeadings; // For headings

class InternshipApplicationsExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        // Get all accepted applications
        return InternshipApplication::where('status', 'Accepted')->get();
    }

    public function map($application): array
    {
        // Map the data to columns
        return [
            $application->full_name,
            $application->email,
            $application->phone,
            $application->institution,
            // Add all other fields you need
        ];
    }

    public function headings(): array
    {
        return [
            'Full Name',
            'Email',
            'Phone',
            'Institution',
            // Add headings for all other fields
        ];
    }
}
