<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Institution;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institutions = ['University of Nairobi', 'Kenyatta University', 'Moi University', 'Jomo Kenyatta University'];

        foreach ($institutions as $institution) {
            Institution::create(['name' => $institution]);
        }
    }
}
