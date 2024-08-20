<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicationsExport implements FromCollection, WithHeadings
{
    protected $type;
    protected $jobTitle;

    public function __construct($type, $jobTitle)
{
    $this->type = ucfirst($type);
    $this->jobTitle = $jobTitle;
}

public function collection()
{
    return Application::where('job_status', $this->type)
        ->when($this->jobTitle, function($query) {
            return $query->whereHas('listing', function($q) {
                $q->where('title', $this->jobTitle);
            });
        })
        ->with(['user.personalInfo', 'listing'])
        ->get()
        ->map(function($application, $index) {
            return [
                'Table Number' => $index + 1,
                'ID Number' => $application->user->personalInfo->idno,
                'Name' => $application->user->personalInfo->firstname . ' ' . $application->user->personalInfo->lastname,
                'Email' => $application->user->email,
                'Mobile Number' => $application->user->personalInfo->mobile_num,
                'Alternate Contact' => $application->user->personalInfo->alt_contact_person . ': ' . $application->user->personalInfo->alt_contact_telephone_num,
                'Job Applied For' => $application->listing->title,
            ];
        });
}


    public function headings(): array
    {
        return [
            'Table Number',
            'ID Number',
            'Name',
            'Email',
            'Mobile Number',
            'Alternate Contact',
            'Job Applied For',
        ];
    }
}
