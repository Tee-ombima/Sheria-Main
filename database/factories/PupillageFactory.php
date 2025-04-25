<?php

namespace Database\Factories;

use App\Models\Pupillage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PupillageFactory extends Factory
{
    protected $model = Pupillage::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'full_name' => $this->faker->name,
            'date_of_birth' => $this->faker->date('Y-m-d', '2000-01-01'), 
            'identity_card_number' => $this->faker->unique()->numerify('############'),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'nationality' => 'Kenyan',
            'ethnicity' => $this->faker->randomElement(['Kikuyu', 'Luo', 'Kalenjin', 'Luhya', 'Kamba']),
            'home_county' => $this->faker->randomElement(['Nairobi', 'Mombasa', 'Kisumu', 'Nakuru', 'Uasin Gishu']),
            'sub_county' => $this->faker->city,
            'disability_status' => $this->faker->boolean(15),
            'nature_of_disability' => $this->faker->optional(0.15)->randomElement(['Physical', 'Visual', 'Hearing']),
            'postal_address' => $this->faker->postcode,
            'postal_code' => $this->faker->postcode,
            'town' => $this->faker->city,
            'physical_address' => $this->faker->streetAddress,
            'mobile_number' => $this->faker->unique()->regexify('/^07[0-9]{8}$/'),
            'alternate_mobile_number' => $this->faker->optional()->regexify('/^07[0-9]{8}$/'),
            'email_address' => $this->faker->unique()->safeEmail,
            'ksce_grade' => $this->faker->randomElement(['A', 'A-', 'B+', 'B']),
            'other_ksce_grade' => null,
            'institution_name' => $this->faker->randomElement(['University of Nairobi', 'Kenyatta University', 'Strathmore University']),
            'other_institution_name' => null,
            'institution_grade' => $this->faker->randomElement(['First Class', 'Second Upper', 'Second Lower']),
            'other_institution_grade' => null,
            'declaration' => true,
            
        ];
    }
}