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
        $jobTitles = [
            'ICT Support Officer',
            'Marketing Manager',
            'Human Resources Assistant',
            'Finance Analyst',
            'Software Developer',
            'Legal Advisor',
            'Customer Service Representative',
            'Operations Manager',
        ];

        // Generate a reference number format: [Dept]/[Year]/[Unique ID]
        $departmentAbbreviations = ['ICT', 'HR', 'FIN', 'MK', 'DEV', 'LEG', 'CS', 'OPS'];
        $department = $this->faker->randomElement($departmentAbbreviations);
        $year = date('Y');
        
        $uniqueId = $this->faker->unique()->randomNumber(5); // Generate a more varied unique ID

        $jobReferenceNumber = "$department/$year/$uniqueId";

        $jobDescriptions = [
            'ICT Support Officer' => 'Responsible for maintaining the computer networks of all types of organizations, providing technical support and ensuring the whole company runs smoothly.',
            'Marketing Manager' => 'Plans, directs, and coordinates the marketing efforts of an organization. Oversees marketing campaigns and promotional activities.',
            'Human Resources Assistant' => 'Assists HR managers in managing employee records, recruiting, and onboarding new hires. Helps organize company events and maintain office policies.',
            'Finance Analyst' => 'Analyzes financial data and performance to provide insights on business performance. Helps in financial planning and risk management.',
            'Software Developer' => 'Designs, develops, and maintains software applications. Works with different programming languages and collaborates with other developers.',
            'Legal Advisor' => 'Provides legal advice to the company on various matters including contracts, compliance, and intellectual property.',
            'Customer Service Representative' => 'Interacts with customers to handle complaints, process orders, and provide information about an organization’s products and services.',
            'Operations Manager' => 'Oversees the day-to-day operations of the company. Ensures efficient processes and monitors performance to meet operational goals.',
        ];

        $jobDuties = [
            'Providing support for desktop applications and network issues.',
            'Managing and leading a team of marketing professionals.',
            'Handling employee records and assisting with recruitment.',
            'Conducting financial analysis and providing recommendations.',
            'Developing and maintaining software applications.',
            'Providing legal counsel and preparing legal documents.',
            'Responding to customer inquiries and resolving issues.',
            'Overseeing operational activities and ensuring compliance.',
        ];

        $qualifications = [
            'Bachelor’s degree in Computer Science or related field.',
            'Bachelor’s degree in Marketing or Business Administration.',
            'Bachelor’s degree in Human Resources or related field.',
            'Bachelor’s degree in Finance or Accounting.',
            'Bachelor’s degree in Computer Science or Software Engineering.',
            'Law degree and member of the bar association.',
            'High school diploma; additional certification in customer service is a plus.',
            'Bachelor’s degree in Business Administration or related field.',
        ];

        $title = $this->faker->randomElement($jobTitles);

        return [
            'title' => $title,
            'tags' => 'mid level,fulltime, remote', // Adjust as needed

            'job_reference_number' => $jobReferenceNumber,
            'description' => "{$jobDescriptions[$title]}\n\nDuties:\n- " . implode("\n- ", $jobDuties) . "\n\nQualifications:\n- " . $this->faker->randomElement($qualifications),
        ];
    }
}
