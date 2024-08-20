<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ethnicity;

class EthnicitySeeder extends Seeder
{
    public function run()
    {
        $ethnicities = [
            'Kikuyu',
            'Luo',
            'Luhya',
            'Kalenjin',
            'Kamba',
            'Meru',
            'Embu',
            'Mijikenda',
            'Swahili',
            'Somali',
            'Turkana',
            'Maasai',
            'Taita',
            'Taveta',
            'Kuria',
            'Kisii',
            'Pokot',
            'Samburu',
            'Giriama',
            'Digo',
            'Tharaka',
            'Embu',
            'Ameru',
            'Teso',
            'Bajuni',
            'Borana',
            'Rendille',
            'Gabra',
            'Orma',
            'Mbeere',
            'Suba',
            'Ogiek',
            'Nubian',
            'Makonde',
            'Awer',
            'Burji',
            'Ilchamus',
            'Sakuye',
            'Sabaot',
            'El Molo',
        ];

        foreach ($ethnicities as $ethnicity) {
            Ethnicity::firstOrCreate(['name' => $ethnicity]);
        }

    }
}
