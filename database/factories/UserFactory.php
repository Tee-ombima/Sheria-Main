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
    ];
}

public function configure()
{
    return $this->afterCreating(function (User $user) {
        // Create all required profile sections
        PersonalInfo::factory()->create(['user_id' => $user->id]);
        AcademicInfo::factory()->create(['user_id' => $user->id]);
        ProfInfo::factory()->create(['user_id' => $user->id]);
        RelevantCourses::factory()->create(['user_id' => $user->id]);
        Attachment::factory()->create(['user_id' => $user->id]);
    });
}

    public function superadmin()
{
    return $this->state(function (array $attributes) {
        return [
            'name' => 'Super Admin',
            'email' => 'ombimatitus7@gmail.com',
            'password' => bcrypt('securepassword'),
            'role' => 'superadmin',
            'permissions' => [
                'manage_users',
                'manage_listings',
                'manage_internships',
                'manage_pupillages',
                'manage_post_pupillages',
                
            ]
        ];
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
