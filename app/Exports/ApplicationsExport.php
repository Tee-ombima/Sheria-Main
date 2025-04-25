<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicationsExport implements FromCollection, WithHeadings
{
    protected $type;
    protected $jobTitle;

    public function __construct(string $type, ?string $jobTitle)
    {
        $this->type     = ucfirst($type);
        $this->jobTitle = $jobTitle;
    }

    public function collection()
    {
        return Application::where('job_status', $this->type)
            ->when($this->jobTitle, fn($q) =>
                $q->whereHas('listing', fn($sq) =>
                    $sq->where('title', $this->jobTitle)
                )
            )
            ->with(['user.personalInfo', 'listing'])
            ->get()
            ->map(function($app, $i) {
                $pi = $app->user->personalInfo;
                return [
                    'Table Number'      => $i + 1,
                    'Job Title'         => $app->listing->title ?? 'N/A',
                    'ID Number'         => $pi->idno ?? 'N/A',
                    'Name'              => trim(($pi->firstname ?? '') . ' ' . ($pi->lastname ?? '')),
                    'Gender'            => $pi->gender  ?? 'N/A',
                    'County'            => $pi->homecounty->name    ?? 'N/A',
                    'Subcounty'         => $pi->subcounty->name     ?? 'N/A',
                    'Constituency'      => $pi->constituency->name  ?? 'N/A',
                    'Email'             => $app->user->email,
                    'Mobile Number'     => $pi->mobile_num           ?? 'N/A',
                    'Alternate Contact' => ($pi->alt_contact_person && $pi->alt_contact_telephone_num)
                        ? "{$pi->alt_contact_person}: {$pi->alt_contact_telephone_num}"
                        : 'N/A',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Table Number',
            'Job Title',
            'ID Number',
            'Name',
            'Gender',
            'County',
            'Subcounty',
            'Constituency',
            'Email',
            'Mobile Number',
            'Alternate Contact',
        ];
    }
}
