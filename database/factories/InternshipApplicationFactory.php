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
            'kra_pin' => $this->generateDummyFilePath('kra_pin'), // Generate dummy file paths
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
    $filePath = 'files/1-mb-example-file.pdf';

    // Create an empty PDF file for testing purposes
    Storage::disk('public')->put($filePath, '');

    return $filePath;
}

}
