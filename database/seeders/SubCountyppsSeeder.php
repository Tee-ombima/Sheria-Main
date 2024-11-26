<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Countypp;
use App\Models\SubCountypp;

class SubCountyppsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subCountypps = [
            // Nairobi SubCounties
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Westlands'],
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Kasarani'],
            // Mombasa SubCounties
            ['county_id' => Countypp::where('name', 'Mombasa')->first()->id, 'name' => 'Changamwe'],
            ['county_id' => Countypp::where('name', 'Mombasa')->first()->id, 'name' => 'Nyali'],
            // Kisumu SubCounties
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu East'],
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu West'],
            // Add more sub-counties as needed
        ];

        SubCountypp::insert($subCountypps);
    }
}
