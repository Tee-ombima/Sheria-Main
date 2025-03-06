<?php

namespace Database\Factories;

use App\Models\InternshipApplication;
use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class InternshipApplicationFactory extends Factory
{
    protected $model = InternshipApplication::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Associate a user with the application
            'full_name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'institution' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'id_file' => $this->generateDummyFilePath('id_file'), // Generate dummy file paths
            'university_letter' => $this->generateDummyFilePath('university_letter'), // Generate dummy file paths
            'application_letter' => $this->generateDummyFilePath('application_letter'), // Generate dummy file paths
            'insurance' => $this->generateDummyFilePath(fileType: 'insurance'), // Generate dummy file paths
            'good_conduct' => $this->generateDummyFilePath(fileType: 'good_conduct'), // Generate dummy file paths
            'cv' => $this->generateDummyFilePath(fileType: 'cv'), // Generate dummy file paths

        ];
    }

    /**
     * Generate a dummy file path.
     *
     * @param string $fileType
     * @return string
     */
    private function generateDummyFilePath(string $fileType): string
{
    $fileName = Str::uuid() . "_{$fileType}.pdf";
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
