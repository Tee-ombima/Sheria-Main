<?php

namespace Database\Factories;

use App\Models\InternshipApplication;
use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'insurance' => $this->generateDummyFilePath('insurance'), // Generate dummy file paths
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
        return 'documents/' . $this->faker->uuid() . "_{$fileType}.pdf"; // Use UUID to ensure unique file names
    }
}
