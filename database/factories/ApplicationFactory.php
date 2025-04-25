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
            'job_reference_number' => $this->faker->unique()->bothify('REF-###-??'),
            'remarks' => sprintf(
                'Please report for interview at %s on %s at %s.',
                $this->faker->randomElement([
                    'Nairobi Law Courts, Haile Selassie Ave',
                    'Mombasa Law Courts, Jomo Kenyatta Ave',
                    'Kisumu Law Courts, Oginga Odinga St'
                ]),
                $this->faker
                     ->dateTimeBetween('now', '+1 month')
                     ->format('F j, Y'),
                $this->faker
                     ->time('g:i A')
            ),
                        'job_status' => $this->faker->randomElement(['Processing', 'Appointed', 'Not_Successful']),
        ];
    }
    
    // Remove the configure() method - profile creation is now handled by UserFactory

   
}
