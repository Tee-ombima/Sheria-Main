<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Legal-related job titles
        $legalJobTitles = [
            'Legal Officer',
            'Corporate Lawyer',
            'Litigation Attorney',
            'Compliance Officer',
            'Legal Counsel',
            'Paralegal',
            'Legal Assistant',
            'Contracts Manager',
            'Intellectual Property Lawyer',
            'Legal Advisor',
            'Legal Researcher',
            'Legal Secretary',
            'Judicial Clerk',
            'Mediator',
            'Arbitrator',
            'Legal Consultant',
            'Legal Analyst',
            'Legal Operations Manager',
            'Legal Risk Manager',
            'Legal Document Reviewer',
        ];

        // Randomly select a legal job title
        $jobTitle = $this->faker->randomElement($legalJobTitles);

        // Generate a reference number format: [Dept]/[Year]/[Unique ID]
        $departmentAbbreviations = ['LEG', 'HR', 'FIN', 'CS', 'OPS']; // LEG for Legal
        $department = $this->faker->randomElement($departmentAbbreviations);
        $year = date('Y');
        $uniqueId = $this->faker->unique()->numberBetween(10000, 99999);
        $jobReferenceNumber = "$department/$year/$uniqueId";

        // Generate a deadline within the next 30 days
        $deadline = $this->faker->dateTimeBetween('now', '+30 days');

        // Generate a dummy file path
        $filePath = $this->generateDummyFilePath();

        return [
            'title' => $jobTitle,
            'job_reference_number' => $jobReferenceNumber,
            'vacancies' => $this->faker->numberBetween(1, 5), // Fewer vacancies for legal roles
            'deadline' => $deadline,
            'file' => $filePath,
        ];
    }

    /**
     * Generate a dummy PDF file and return its path.
     *
     * @return string
     */
    private function generateDummyFilePath(): string
    {
        $fileName = Str::uuid() . '.pdf';
        $filePath = "files/{$fileName}";

        // Minimal PDF content (this creates a valid PDF structure)
        $pdfContent = "%PDF-1.4
%âãÏÓ
1 0 obj
<< /Type /Catalog /Pages 2 0 R >>
endobj
2 0 obj
<< /Type /Pages /Kids [3 0 R] /Count 1 >>
endobj
3 0 obj
<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] >>
endobj
xref
0 4
0000000000 65535 f 
0000000010 00000 n 
0000000052 00000 n 
0000000100 00000 n 
trailer
<< /Root 1 0 R /Size 4 >>
startxref
150
%%EOF";

        // Save the valid PDF content to the file
        Storage::disk('public')->put($filePath, $pdfContent);

        return $filePath;
    }
}