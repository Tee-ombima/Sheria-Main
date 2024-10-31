<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\PersonalInfo;
use App\Models\AcademicInfo;
use App\Models\ProfInfo;
use App\Models\RelevantCourses;
use App\Models\Attachment;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role' => 'user',
            
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            // Create personal info
            PersonalInfo::factory()->create(['user_id' => $user->id]);

            // Create academic info
            AcademicInfo::factory()->count(2)->create(['user_id' => $user->id]);

            // Create professional info
            ProfInfo::factory()->count(2)->create(['user_id' => $user->id]);

            // Create relevant courses
            RelevantCourses::factory()->count(2)->create(['user_id' => $user->id]);

            // Create attachments
            Attachment::factory()->count(3)->create(['user_id' => $user->id]);
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
