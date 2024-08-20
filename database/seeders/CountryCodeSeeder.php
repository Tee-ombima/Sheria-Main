<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CountryCode;

class CountryCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countryCodes = [
            ['name' => 'Kenya', 'code' => '+254'],
            ['name' => 'United States', 'code' => '+1'],
            ['name' => 'United Kingdom', 'code' => '+44'],
            ['name' => 'Canada', 'code' => '+1'],
            ['name' => 'Australia', 'code' => '+61'],
            ['name' => 'Germany', 'code' => '+49'],
            // Add more country codes as needed
        ];

        foreach ($countryCodes as $countryCode) {
            CountryCode::firstOrCreate($countryCode);
        }
    }
}
