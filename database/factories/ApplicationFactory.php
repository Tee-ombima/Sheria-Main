<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\User;
use App\Models\Listing;
use App\Models\PersonalInfo;
use App\Models\AcademicInfo;
use App\Models\ProfInfo;
use App\Models\RelevantCourses;
use App\Models\Attachment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'job_id' => Listing::factory(),
            'idno' => $this->faker->unique()->numberBetween(10000000, 99999999),
            'name' => $this->faker->name,
            'job_title' => $this->faker->jobTitle,
            'job_reference_number' => $this->faker->unique()->word,
            'remarks' => $this->faker->sentence,
            'job_status' => $this->faker->randomElement(['Processing', 'Appointed', 'Rejected']),
        ];
    }

    // Ensure all related information exists
    public function configure()
    {
        return $this->afterCreating(function (Application $application) {
            PersonalInfo::factory()->create(['user_id' => $application->user_id]);
            AcademicInfo::factory()->create(['user_id' => $application->user_id]);
            ProfInfo::factory()->create(['user_id' => $application->user_id]);
            RelevantCourses::factory()->create(['user_id' => $application->user_id]);
            Attachment::factory()->create(['user_id' => $application->user_id]);
        });
    }
}
