<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\User;
use App\Models\DocumentName;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AttachmentFactory extends Factory
{
    protected $model = Attachment::class;

    public function definition()
    {
        // Fetch a random document name from the existing document names in the database
        $documentName = DocumentName::inRandomOrder()->first();

        return [
            'user_id' => User::factory(),
            'document_name' => $documentName ? $documentName->name : 'Default Document Name',
            'file_path' => $this->generateDummyFilePath(), // Generate a dummy PDF
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
        $filePath = "attachments/{$fileName}";

        // Minimal PDF content (creates a valid PDF structure)
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
