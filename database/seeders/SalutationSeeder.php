<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Salutation;

class SalutationSeeder extends Seeder
{
    public function run()
    {
        // Define the salutations you want to seed
        $salutations = ['Mr.', 'Mrs.', 'Miss', 'Dr.', 'Prof.', 'Rev.', 'Ms.'];

        // Seed the salutations using firstOrCreate to avoid duplicates
        foreach ($salutations as $salutation) {
            Salutation::firstOrCreate(['name' => $salutation]);
        }
    }
}
