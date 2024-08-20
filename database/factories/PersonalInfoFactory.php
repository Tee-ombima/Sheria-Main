<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; // Ensure you import the User model
use App\Models\PersonalInfo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalInfo>
 */
class PersonalInfoFactory extends Factory
{
    protected $model = PersonalInfo::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            // Add other necessary fields here
        ];
    }
}
