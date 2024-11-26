<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCountyp;
use App\Models\Countyp;
class SubCountypsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subCountyps = [
            // Nairobi SubCounties
            ['county_id' => Countyp::where('name', 'Nairobi')->first()->id, 'name' => 'Westlands'],
            ['county_id' => Countyp::where('name', 'Nairobi')->first()->id, 'name' => 'Kasarani'],
            // Mombasa SubCounties
            ['county_id' => Countyp::where('name', 'Mombasa')->first()->id, 'name' => 'Changamwe'],
            ['county_id' => Countyp::where('name', 'Mombasa')->first()->id, 'name' => 'Nyali'],
            // Kisumu SubCounties
            ['county_id' => Countyp::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu East'],
            ['county_id' => Countyp::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu West'],
            // Add more sub-counties as needed
        ];

        SubCountyp::insert($subCountyps);
    }
}
