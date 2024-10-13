<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Generate random job titles
        $jobTitle = $this->faker->jobTitle();

        // Generate a reference number format: [Dept]/[Year]/[Unique ID]
        $departmentAbbreviations = ['ICT', 'HR', 'FIN', 'MK', 'DEV', 'LEG', 'CS', 'OPS'];
        $department = $this->faker->randomElement($departmentAbbreviations);
        $year = date('Y');
        $uniqueId = $this->faker->unique()->numberBetween(10000, 99999);        $jobReferenceNumber = "$department/$year/$uniqueId";

        // Randomly generate a job description
        $description = $this->faker->paragraphs($this->faker->numberBetween(2, 5), true); // 2 to 5 paragraphs

        // Generate random job duties
        $dutiesCount = $this->faker->numberBetween(3, 6);
        $jobDuties = [];
        for ($i = 0; $i < $dutiesCount; $i++) {
            $jobDuties[] = $this->faker->sentence();
        }

        // Generate random qualifications
        $qualificationsCount = $this->faker->numberBetween(1, 3);
        $qualifications = [];
        for ($i = 0; $i < $qualificationsCount; $i++) {
            $qualifications[] = $this->faker->sentence();
        }

        return [
            'title' => $jobTitle,
            'tags' => 'mid level, fulltime, remote', // Adjust as needed
            'job_reference_number' => $jobReferenceNumber,
            'description' => "$description\n\nDuties:\n- " . implode("\n- ", $jobDuties) . "\n\nQualifications:\n- " . implode("\n- ", $qualifications),
        ];
    }
}
