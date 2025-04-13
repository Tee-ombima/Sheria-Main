<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FullListingExport implements FromCollection, WithHeadings, WithMapping
{
    protected $listingId;
    protected $maxAcademicEntries = 5;
    protected $maxProfessionalEntries = 5;
    protected $maxCourses = 5;
    protected $maxAttachments = 5;

    public function __construct($listingId)
    {
        $this->listingId = $listingId;
    }

    public function collection()
    {
        return Application::with([
                'user.personalInfo',
                'user.academicInfo',
                'user.profInfo',
                'user.relevantCourses',
                'user.attachmentInfo',
                'listing'
            ])
            ->where('job_id', $this->listingId)
            ->get();
    }

    public function headings(): array
    {
        $headings = [
            // Personal Information
            'ID Number', 'Full Name', 'Gender', 'Date of Birth', 'KRA PIN', 'Nationality',
            'County', 'Subcounty', 'Constituency', 'Mobile Number', 'Email', 
            'Alternative Contact', 'Disability Information'
        ];

        // Academic Information (Up to 5 entries)
        for ($i = 1; $i <= $this->maxAcademicEntries; $i++) {
            $headings = array_merge($headings, [
                "Academic Institution $i", 
                "Academic Course $i", 
                "Academic Start Date $i", 
                "Academic End Date $i",
                "Academic Certificate No $i"
            ]);
        }

        // Professional Information (Up to 5 entries)
        for ($i = 1; $i <= $this->maxProfessionalEntries; $i++) {
            $headings = array_merge($headings, [
                "Professional Institution $i", 
                "Professional Course $i", 
                "Professional Start Date $i", 
                "Professional End Date $i",
                "Professional Certificate No $i"
            ]);
        }

        // Relevant Courses (Up to 5 entries)
        for ($i = 1; $i <= $this->maxCourses; $i++) {
            $headings = array_merge($headings, [
                "Course Name $i", 
                "Course Institution $i", 
                "Course Issue Date $i"
            ]);
        }

        // Attachments (Up to 5 entries)
        for ($i = 1; $i <= $this->maxAttachments; $i++) {
            $headings[] = "Attachment $i";
        }

        // Employment History
        $headings = array_merge($headings, [
            'Ministry', 'Station', 'Current Post', 'Appointment Date', 'Job Group'
        ]);

        return $headings;
    }

    public function map($application): array
    {
        $data = [
            // Personal Information
            $application->user->personalInfo->idno,
            $application->user->personalInfo->firstname.' '.$application->user->personalInfo->lastname,
            $application->user->personalInfo->gender,
            $application->user->personalInfo->dob,
            $application->user->personalInfo->kra_pin,
            $application->user->personalInfo->nationality,
            $this->getCounty($application),
            $this->getSubcounty($application),
            $this->getConstituency($application),
            $application->user->personalInfo->mobile_num,
            $application->user->email,
            $application->user->personalInfo->alt_contact_person.': '.$application->user->personalInfo->alt_contact_telephone_num,
            $application->user->personalInfo->nature_of_disability ?? 'N/A'
        ];

        // Academic Information
        $data = array_merge($data, $this->mapAcademicInfo($application));

        // Professional Information
        $data = array_merge($data, $this->mapProfessionalInfo($application));

        // Relevant Courses
        $data = array_merge($data, $this->mapRelevantCourses($application));

        // Attachments
        $data = array_merge($data, $this->mapAttachments($application));

        // Employment History
        $data = array_merge($data, [
            $application->user->personalInfo->ministry,
            $application->user->personalInfo->station,
            $application->user->personalInfo->present_substantive_post,
            $application->user->personalInfo->date_of_current_appointment,
            $application->user->personalInfo->job_group
        ]);

        return $data;
    }

    private function getCounty($application)
    {
        $county = $application->user->personalInfo->homecounty;
        return $county->name === 'other' 
            ? $application->user->personalInfo->homecounty_other
            : $county->name;
    }

    private function getSubcounty($application)
    {
        $subcounty = $application->user->personalInfo->subcounty;
        return $subcounty->name === 'other' 
            ? $application->user->personalInfo->subcounty_other
            : $subcounty->name;
    }

    private function getConstituency($application)
    {
        $constituency = $application->user->personalInfo->constituency;
        return $constituency->name === 'other' 
            ? $application->user->personalInfo->constituency_other
            : $constituency->name;
    }

    private function mapAcademicInfo($application)
    {
        $academicData = [];
        foreach ($application->user->academicInfo->take($this->maxAcademicEntries) as $academic) {
            $academicData = array_merge($academicData, [
                $academic->institution_name,
                $academic->course,
                $academic->start_date,
                $academic->end_date,
                $academic->certificate_no
            ]);
        }
        return array_pad($academicData, $this->maxAcademicEntries * 5, null);
    }

    private function mapProfessionalInfo($application)
    {
        $professionalData = [];
        foreach ($application->user->profInfo->take($this->maxProfessionalEntries) as $prof) {
            $professionalData = array_merge($professionalData, [
                $prof->prof_institution_name,
                $prof->prof_course,
                $prof->prof_start_date,
                $prof->prof_end_date,
                $prof->prof_certificate_no
            ]);
        }
        return array_pad($professionalData, $this->maxProfessionalEntries * 5, null);
    }

    private function mapRelevantCourses($application)
    {
        $coursesData = [];
        foreach ($application->user->relevantCourses->take($this->maxCourses) as $course) {
            $coursesData = array_merge($coursesData, [
                $course->rel_course,
                $course->rel_institution_name,
                $course->rel_issue_date
            ]);
        }
        return array_pad($coursesData, $this->maxCourses * 3, null);
    }

    private function mapAttachments($application)
    {
        $attachments = [];
        foreach ($application->user->attachmentInfo->take($this->maxAttachments) as $attachment) {
            $attachments[] = '=HYPERLINK("'.asset('storage/'.$attachment->file_path).'","'.$attachment->file_name.'")';
        }
        return array_pad($attachments, $this->maxAttachments, null);
    }
}