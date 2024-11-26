<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Countypp;

class CountyppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countypps = [
            ['name' => 'Nairobi'],
            ['name' => 'Mombasa'],
            ['name' => 'Kisumu'],
            // Add more counties as needed
        ];

        Countypp::insert($countypps);
    }
}
