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
        $uniqueId = $this->faker->unique()->numberBetween(10000, 99999);
        $jobReferenceNumber = "$department/$year/$uniqueId";

        // Generate a detailed job description with sections
        $jobOverview = $this->faker->paragraphs(3, true);  // 3 paragraphs for job overview
        $jobDuties = $this->faker->sentences(6); // 6 duties
        $qualifications = $this->faker->sentences(5); // 5 qualifications
        $salary = $this->faker->numberBetween(50000, 150000);  // Salary example
        $deadline = $this->faker->dateTimeBetween('-10 days', '+30 days');


        // Create the formatted job description
        $description = "
            **Job Overview:**

            $jobOverview

            **Key Job Duties:**
            - " . implode("\n            - ", $jobDuties) . "

            **Qualifications:**
            - " . implode("\n            - ", $qualifications) . "

            **Salary:** \$" . number_format($salary) . " per annum
        ";
        $filePath = 'files/5-mb-example-file.pdf';


        return [
            'title' => $jobTitle,
            'job_reference_number' => $jobReferenceNumber,
            'vacancies' => $this->faker->numberBetween(1, 10), // Random number of vacancies
            'deadline' => $deadline,
            'file' => $filePath,
        ];
    }
}
