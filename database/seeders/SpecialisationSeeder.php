<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialisation;

class SpecialisationSeeder extends Seeder
{
    public function run()
    {
        $specialisations = [
            'Software Engineering',
            'Marketing',
            'Journalism and Mass Communication',
            'Early Childhood Education',
            'Corporate Law',
            'Cardiology',
            'Pediatrics',
            'Civil Engineering',
            'Network Administration',
            'Entrepreneurship',
        ];

        foreach ($specialisations as $specialisation) {
            Specialisation::firstOrCreate(['name' => $specialisation]);
        }
    }
}
