<?php

namespace Database\Factories;

use App\Models\PostPupillage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostPupillageFactory extends Factory
{
    protected $model = PostPupillage::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'vacancy_no' => 'VAC-' . $this->faker->unique()->numerify('####'),
            'full_name' => $this->faker->name,
            'date_of_birth' => $this->faker->date('Y-m-d', '2000-01-01'), 
            'identity_card_number' => $this->faker->unique()->numerify('############'),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'kra_pin' => strtoupper(Str::random(11)),
            'nhif_card_number' => $this->faker->unique()->numerify('##########'),
            'postal_address' => $this->faker->address,
            'postal_code' => $this->faker->postcode,
            'town' => $this->faker->city,
            'email_address' => $this->faker->unique()->safeEmail,
            'mobile_number' => $this->faker->unique()->regexify('/^07[0-9]{8}$/'),
            'home_county' => $this->faker->randomElement(['Nairobi', 'Mombasa', 'Kisumu', 'Nakuru']),
            'sub_county' => $this->faker->city,
            'ethnicity' => $this->faker->randomElement(['Kikuyu', 'Luo', 'Kalenjin', 'Luhya']),
            'disability_status' => $this->faker->boolean(15),
            'nature_of_disability' => $this->faker->optional(0.15)->randomElement(['Physical', 'Visual', 'Hearing']),
            'deployment_region' => $this->faker->randomElement(['Nairobi', 'Coast', 'Western', 'Rift Valley']),
            'declaration' => true,
            
            'remarks' => $this->faker->optional()->sentence
        ];
    }
}