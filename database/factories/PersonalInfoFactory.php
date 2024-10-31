<?php

namespace Database\Factories;

use App\Models\PersonalInfo;
use App\Models\User;
use App\Models\Homecounty;
use App\Models\Constituency;
use App\Models\Subcounty;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonalInfoFactory extends Factory
{
    protected $model = PersonalInfo::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Creates a new user for each personal info record
            'homecounty_id' => Homecounty::inRandomOrder()->first()->id, // Fetch random home county
            'constituency_id' => Constituency::inRandomOrder()->first()->id, // Fetch random constituency
            'subcounty_id' => Subcounty::inRandomOrder()->first()->id, // Fetch random subcounty
            'surname' => $this->faker->lastName, // Generate random surname
            'firstname' => $this->faker->firstName, // Generate random first name
            'lastname' => $this->faker->lastName, // Optional, generates random last name
            'salutation' => $this->faker->title, // Salutation (e.g., Mr., Ms., Dr.)
            'dob' => $this->faker->date('Y-m-d', '2000-01-01'), // Default DOB if not provided
            'idno' => $this->faker->unique()->numerify('########'), // 8-digit ID number
            'kra_pin' => strtoupper($this->faker->bothify('?????#####')), // Generate KRA PIN (e.g., ABCD12345)
            'gender' => $this->faker->randomElement(['male', 'female']), // Randomly assign male or female
            'nationality' => $this->faker->country, // Generate a random country name
            'ethnicity' => $this->faker->randomElement(['Kikuyu', 'Luo', 'Kalenjin', 'Luhya', 'Maasai', 'Others']), // Random ethnicity
            'postal_address' => $this->faker->address, // Generate random address
            'code' => $this->faker->postcode, // Postal code
            'town_city' => $this->faker->city, // Random city
            'telephone_num' => $this->faker->optional()->phoneNumber, // Optional telephone number
            'mobile_num' => $this->faker->phoneNumber, // Mobile number
            'email_address' => $this->faker->safeEmail, // Random email address
            'alt_contact_person' => $this->faker->name, // Alternate contact person name
            'alt_contact_telephone_num' => $this->faker->phoneNumber, // Alternate contact phone number
            'disability_question' => $this->faker->optional()->randomElement(['Yes', 'No']), // Optional disability question
            'nature_of_disability' => $this->faker->optional()->sentence, // Optional nature of disability
            'ncpd_registration_no' => $this->faker->optional()->numerify('NCPD#####'), // Optional NCPD registration number
            'ministry' => $this->faker->optional()->company, // Optional ministry name
            'station' => $this->faker->optional()->city, // Optional station
            'personal_employment_number' => $this->faker->optional()->numerify('EMP#####'), // Optional employment number
            'present_substantive_post' => $this->faker->optional()->jobTitle, // Optional substantive post
            'job_grp_scale_grade' => $this->faker->optional()->randomElement(['A', 'B', 'C', 'D']), // Optional job grade
            'date_of_current_appointment' => $this->faker->optional()->date(), // Optional date of current appointment
            'upgraded_post' => $this->faker->optional()->jobTitle, // Optional upgraded post
            'effective_date_previous_appointment' => $this->faker->optional()->date(), // Optional effective date of previous appointment
            'on_secondment_organization' => $this->faker->optional()->company, // Optional secondment organization
            'designation' => $this->faker->optional()->jobTitle, // Optional designation
            'job_group' => $this->faker->optional()->randomElement(['Job Group A', 'Job Group B', 'Job Group C']), // Optional job group
            'terms_of_service' => $this->faker->optional()->randomElement(['Permanent', 'Contract', 'Temporary']), // Optional terms of service
        ];
    }
}
