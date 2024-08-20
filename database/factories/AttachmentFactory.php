<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\User;
use App\Models\DocumentName;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttachmentFactory extends Factory
{
    protected $model = Attachment::class;

    public function definition()
    {
        // Fetch a random document name from the existing document names in the database
        $documentName = DocumentName::inRandomOrder()->first();

        return [
            'user_id' => User::factory(),
            'document_name' => $documentName->name, // Use the name from the existing records
            'file_path' => $this->faker->filePath(), // For example purposes, adjust this to your logic for file paths
        ];
    }
}
