<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Countyp;

class CountypSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countyps = [
            ['name' => 'Nairobi'],
            ['name' => 'Mombasa'],
            ['name' => 'Kisumu'],
            // Add more counties as needed
        ];

        Countyp::insert($countyps);
    }
}
