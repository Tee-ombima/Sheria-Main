<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Homecounty;
use App\Models\Constituency;
use App\Models\Subcounty;

class HomecountySeeder extends Seeder
{
    public function run()
    {
        $homecounties = [
            ['name' => 'Mombasa'],
            ['name' => 'Kwale'],
            ['name' => 'Kilifi'],
            ['name' => 'Tana River'],
            ['name' => 'Lamu'],
            ['name' => 'Taita-Taveta'],
            ['name' => 'Garissa'],
            ['name' => 'Wajir'],
            ['name' => 'Mandera'],
            ['name' => 'Marsabit'],
            ['name' => 'Isiolo'],
            ['name' => 'Meru'],
            ['name' => 'Tharaka-Nithi'],
            ['name' => 'Embu'],
            ['name' => 'Kitui'],
            ['name' => 'Machakos'],
            ['name' => 'Makueni'],
            ['name' => 'Nyandarua'],
            ['name' => 'Nyeri'],
            ['name' => 'Kirinyaga'],
            ['name' => 'Murang\'a'],
            ['name' => 'Kiambu'],
            ['name' => 'Turkana'],
            ['name' => 'West Pokot'],
            ['name' => 'Samburu'],
            ['name' => 'Trans Nzoia'],
            ['name' => 'Uasin Gishu'],
            ['name' => 'Elgeyo-Marakwet'],
            ['name' => 'Nandi'],
            ['name' => 'Baringo'],
            ['name' => 'Laikipia'],
            ['name' => 'Nakuru'],
            ['name' => 'Narok'],
            ['name' => 'Kajiado'],
            ['name' => 'Kericho'],
            ['name' => 'Bomet'],
            ['name' => 'Kakamega'],
            ['name' => 'Vihiga'],
            ['name' => 'Bungoma'],
            ['name' => 'Busia'],
            ['name' => 'Siaya'],
            ['name' => 'Kisumu'],
            ['name' => 'Homa Bay'],
            ['name' => 'Migori'],
            ['name' => 'Kisii'],
            ['name' => 'Nyamira'],
            ['name' => 'Nairobi City'],
        ];

        Homecounty::insert($homecounties);
    }

}