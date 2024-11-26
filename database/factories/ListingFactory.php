<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

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
        $uniqueId = $this->faker->unique()->numberBetween(10000, 99999);
        $jobReferenceNumber = "$department/$year/$uniqueId";
        $deadline = $this->faker->dateTimeBetween('-10 days', '+30 days');
        $filePath = 'files/1-mb-example-file.pdf';


        return [
            'title' => $jobTitle,
            'job_reference_number' => $jobReferenceNumber,
            'vacancies' => $this->faker->numberBetween(1, 10), // Random number of vacancies
            'deadline' => $deadline,
            'file' => $filePath,
            

        ];
    }
}
