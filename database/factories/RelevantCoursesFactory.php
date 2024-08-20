<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; // Ensure you import the User model
use App\Models\RelevantCourses;
use App\Models\Course;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RelevantCourses>
 */
class RelevantCoursesFactory extends Factory
{
    protected $model = RelevantCourses::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'rel_course' => Course::inRandomOrder()->first()->name, // Updated to match the migration
            'rel_institution_name' => $this->faker->company, // Updated to match the migration
            'rel_certificate_no' => $this->faker->randomNumber(8), // Added to match the migration
            'rel_issue_date' => $this->faker->date('Y-m-d'), // Updated to match the migration
        ];
    }
}
