<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Constituency;
use App\Models\Homecounty;

class ConstituencySeeder extends Seeder
{
    public function run()
    {
        $homecounties = Homecounty::all()->keyBy('name');

        $constituencies = [
            // Mombasa County
            ['name' => 'Changamwe', 'homecounty_id' => $homecounties['Mombasa']->id],
            ['name' => 'Jomvu', 'homecounty_id' => $homecounties['Mombasa']->id],
            ['name' => 'Kisauni', 'homecounty_id' => $homecounties['Mombasa']->id],
            ['name' => 'Nyali', 'homecounty_id' => $homecounties['Mombasa']->id],
            ['name' => 'Likoni', 'homecounty_id' => $homecounties['Mombasa']->id],
            ['name' => 'Mvita', 'homecounty_id' => $homecounties['Mombasa']->id],

            // Nairobi City County
            ['name' => 'Westlands', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Dagoretti North', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Dagoretti South', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Langata', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Kibra', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Roysambu', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Kasarani', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Ruaraka', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Embakasi South', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Embakasi North', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Embakasi Central', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Embakasi East', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Embakasi West', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Makadara', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Kamukunji', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Starehe', 'homecounty_id' => $homecounties['Nairobi City']->id],
            ['name' => 'Mathare', 'homecounty_id' => $homecounties['Nairobi City']->id],

            // Add other counties and their constituencies similarly
            // For example:

            // Kiambu County
            ['name' => 'Kabete', 'homecounty_id' => $homecounties['Kiambu']->id],
            ['name' => 'Gatundu South', 'homecounty_id' => $homecounties['Kiambu']->id],
            ['name' => 'Gatundu North', 'homecounty_id' => $homecounties['Kiambu']->id],
            ['name' => 'Juja', 'homecounty_id' => $homecounties['Kiambu']->id],
            ['name' => 'Thika Town', 'homecounty_id' => $homecounties['Kiambu']->id],
            ['name' => 'Ruiru', 'homecounty_id' => $homecounties['Kiambu']->id],
            ['name' => 'Githunguri', 'homecounty_id' => $homecounties['Kiambu']->id],
            ['name' => 'Kiambu', 'homecounty_id' => $homecounties['Kiambu']->id],
            ['name' => 'Kiambaa', 'homecounty_id' => $homecounties['Kiambu']->id],
            ['name' => 'Limuru', 'homecounty_id' => $homecounties['Kiambu']->id],
            ['name' => 'Lari', 'homecounty_id' => $homecounties['Kiambu']->id],

            
            ['name' => 'Kikuyu', 'homecounty_id' => $homecounties['Kiambu']->id],

            // **Constituencies for Other Counties**
            // Below are the remaining constituencies for all other counties not previously mentioned

            // **Kwale County**
            ['name' => 'Msambweni', 'homecounty_id' => $homecounties['Kwale']->id],
            ['name' => 'Lunga Lunga', 'homecounty_id' => $homecounties['Kwale']->id],
            ['name' => 'Matuga', 'homecounty_id' => $homecounties['Kwale']->id],
            ['name' => 'Kinango', 'homecounty_id' => $homecounties['Kwale']->id],

            // **Tana River County**
            ['name' => 'Garsen', 'homecounty_id' => $homecounties['Tana River']->id],
            ['name' => 'Galole', 'homecounty_id' => $homecounties['Tana River']->id],
            ['name' => 'Bura', 'homecounty_id' => $homecounties['Tana River']->id],

            // **Lamu County**
            ['name' => 'Lamu East', 'homecounty_id' => $homecounties['Lamu']->id],
            ['name' => 'Lamu West', 'homecounty_id' => $homecounties['Lamu']->id],

            // **Taita-Taveta County**
            ['name' => 'Taveta', 'homecounty_id' => $homecounties['Taita-Taveta']->id],
            ['name' => 'Wundanyi', 'homecounty_id' => $homecounties['Taita-Taveta']->id],
            ['name' => 'Mwatate', 'homecounty_id' => $homecounties['Taita-Taveta']->id],
            ['name' => 'Voi', 'homecounty_id' => $homecounties['Taita-Taveta']->id],

            // **Garissa County**
            ['name' => 'Garissa Township', 'homecounty_id' => $homecounties['Garissa']->id],
            ['name' => 'Balambala', 'homecounty_id' => $homecounties['Garissa']->id],
            ['name' => 'Lagdera', 'homecounty_id' => $homecounties['Garissa']->id],
            ['name' => 'Dadaab', 'homecounty_id' => $homecounties['Garissa']->id],
            ['name' => 'Fafi', 'homecounty_id' => $homecounties['Garissa']->id],
            ['name' => 'Ijara', 'homecounty_id' => $homecounties['Garissa']->id],

            // **Wajir County**
            ['name' => 'Wajir North', 'homecounty_id' => $homecounties['Wajir']->id],
            ['name' => 'Wajir East', 'homecounty_id' => $homecounties['Wajir']->id],
            ['name' => 'Tarbaj', 'homecounty_id' => $homecounties['Wajir']->id],
            ['name' => 'Wajir West', 'homecounty_id' => $homecounties['Wajir']->id],
            ['name' => 'Eldas', 'homecounty_id' => $homecounties['Wajir']->id],
            ['name' => 'Wajir South', 'homecounty_id' => $homecounties['Wajir']->id],

            // **Mandera County**
            ['name' => 'Mandera West', 'homecounty_id' => $homecounties['Mandera']->id],
            ['name' => 'Banissa', 'homecounty_id' => $homecounties['Mandera']->id],
            ['name' => 'Mandera North', 'homecounty_id' => $homecounties['Mandera']->id],
            ['name' => 'Mandera South', 'homecounty_id' => $homecounties['Mandera']->id],
            ['name' => 'Mandera East', 'homecounty_id' => $homecounties['Mandera']->id],
            ['name' => 'Lafey', 'homecounty_id' => $homecounties['Mandera']->id],

            // **Marsabit County**
            ['name' => 'Moyale', 'homecounty_id' => $homecounties['Marsabit']->id],
            ['name' => 'North Horr', 'homecounty_id' => $homecounties['Marsabit']->id],
            ['name' => 'Saku', 'homecounty_id' => $homecounties['Marsabit']->id],
            ['name' => 'Laisamis', 'homecounty_id' => $homecounties['Marsabit']->id],

            // **Isiolo County**
            ['name' => 'Isiolo North', 'homecounty_id' => $homecounties['Isiolo']->id],
            ['name' => 'Isiolo South', 'homecounty_id' => $homecounties['Isiolo']->id],

            // **Meru County** (Previously mentioned, so skipping)

            // **Tharaka-Nithi County**
            ['name' => 'Maara', 'homecounty_id' => $homecounties['Tharaka-Nithi']->id],
            ['name' => 'Chuka/Igambang\'ombe', 'homecounty_id' => $homecounties['Tharaka-Nithi']->id],
            ['name' => 'Tharaka', 'homecounty_id' => $homecounties['Tharaka-Nithi']->id],

            // **Embu County**
            ['name' => 'Manyatta', 'homecounty_id' => $homecounties['Embu']->id],
            ['name' => 'Runyenjes', 'homecounty_id' => $homecounties['Embu']->id],
            ['name' => 'Mbeere South', 'homecounty_id' => $homecounties['Embu']->id],
            ['name' => 'Mbeere North', 'homecounty_id' => $homecounties['Embu']->id],

            // **Kitui County**
            ['name' => 'Mwingi North', 'homecounty_id' => $homecounties['Kitui']->id],
            ['name' => 'Mwingi West', 'homecounty_id' => $homecounties['Kitui']->id],
            ['name' => 'Mwingi Central', 'homecounty_id' => $homecounties['Kitui']->id],
            ['name' => 'Kitui West', 'homecounty_id' => $homecounties['Kitui']->id],
            ['name' => 'Kitui Rural', 'homecounty_id' => $homecounties['Kitui']->id],
            ['name' => 'Kitui Central', 'homecounty_id' => $homecounties['Kitui']->id],
            ['name' => 'Kitui East', 'homecounty_id' => $homecounties['Kitui']->id],
            ['name' => 'Kitui South', 'homecounty_id' => $homecounties['Kitui']->id],
        ];

        Constituency::insert($constituencies);
    }

}