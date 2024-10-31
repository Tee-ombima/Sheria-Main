<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subcounty;
use App\Models\Constituency;
use App\Models\Homecounty;

class SubcountySeeder extends Seeder
{
    
    public function run()
    {
        $constituencies = Constituency::all()->keyBy('name');

        $subcounties = [
            // Constituency: Westlands (Nairobi City)
            ['name' => 'Kitisuru', 'constituency_id' => $constituencies['Westlands']->id],
            ['name' => 'Parklands/Highridge', 'constituency_id' => $constituencies['Westlands']->id],
            ['name' => 'Karura', 'constituency_id' => $constituencies['Westlands']->id],
            ['name' => 'Kangemi', 'constituency_id' => $constituencies['Westlands']->id],
            ['name' => 'Mountain View', 'constituency_id' => $constituencies['Westlands']->id],

            // Constituency: Langata (Nairobi City)
            ['name' => 'Karen', 'constituency_id' => $constituencies['Langata']->id],
            ['name' => 'Nairobi West', 'constituency_id' => $constituencies['Langata']->id],
            ['name' => 'Mugumo-Ini', 'constituency_id' => $constituencies['Langata']->id],
            ['name' => 'South C', 'constituency_id' => $constituencies['Langata']->id],
            ['name' => 'Nyayo Highrise', 'constituency_id' => $constituencies['Langata']->id],

            // Constituency: Kiambu (Kiambu County)
            ['name' => 'Ndumberi', 'constituency_id' => $constituencies['Kiambu']->id],
            ['name' => 'Riabai', 'constituency_id' => $constituencies['Kiambu']->id],
            ['name' => 'Township', 'constituency_id' => $constituencies['Kiambu']->id],
            ['name' => 'Ting\'ang\'a', 'constituency_id' => $constituencies['Kiambu']->id],

             // Constituency: Gatundu South
             ['name' => 'Kiamwangi', 'constituency_id' => $constituencies['Gatundu South']->id],
             ['name' => 'Kiganjo', 'constituency_id' => $constituencies['Gatundu South']->id],
             ['name' => 'Ndarugu', 'constituency_id' => $constituencies['Gatundu South']->id],
             ['name' => 'Ng\'enda', 'constituency_id' => $constituencies['Gatundu South']->id],
 
             // Constituency: Gatundu North
             ['name' => 'Chania', 'constituency_id' => $constituencies['Gatundu North']->id],
             ['name' => 'Mang\'u', 'constituency_id' => $constituencies['Gatundu North']->id],
             ['name' => 'Kaal', 'constituency_id' => $constituencies['Gatundu North']->id],
             ['name' => 'Kamwangi', 'constituency_id' => $constituencies['Gatundu North']->id],
 
             // Constituency: Juja
             ['name' => 'Witeithie', 'constituency_id' => $constituencies['Juja']->id],
             ['name' => 'Murera', 'constituency_id' => $constituencies['Juja']->id],
             ['name' => 'Theta', 'constituency_id' => $constituencies['Juja']->id],
             ['name' => 'Juja', 'constituency_id' => $constituencies['Juja']->id],
             ['name' => 'Kalimoni', 'constituency_id' => $constituencies['Juja']->id],
 
             // Constituency: Thika Town
             ['name' => 'Township', 'constituency_id' => $constituencies['Thika Town']->id],
             ['name' => 'Hospital', 'constituency_id' => $constituencies['Thika Town']->id],
             ['name' => 'Kamenu', 'constituency_id' => $constituencies['Thika Town']->id],
             ['name' => 'Gatuanyaga', 'constituency_id' => $constituencies['Thika Town']->id],
             ['name' => 'Ngoliba', 'constituency_id' => $constituencies['Thika Town']->id],
 
             // Constituency: Ruiru
             ['name' => 'Gitothua', 'constituency_id' => $constituencies['Ruiru']->id],
             ['name' => 'Biashara', 'constituency_id' => $constituencies['Ruiru']->id],
             ['name' => 'Githurai', 'constituency_id' => $constituencies['Ruiru']->id],
             ['name' => 'Kahawa Sukari', 'constituency_id' => $constituencies['Ruiru']->id],
             ['name' => 'Kahawa Wendani', 'constituency_id' => $constituencies['Ruiru']->id],
             ['name' => 'Kiuu', 'constituency_id' => $constituencies['Ruiru']->id],
             ['name' => 'Mwihoko', 'constituency_id' => $constituencies['Ruiru']->id],
             ['name' => 'Kahawa Kaskazini', 'constituency_id' => $constituencies['Ruiru']->id],
 
             // **Subcounties for Other Constituencies**
 
             // **Constituency: Msambweni (Kwale County)**
             ['name' => 'Gombato Bongwe', 'constituency_id' => $constituencies['Msambweni']->id],
             ['name' => 'Ukunda', 'constituency_id' => $constituencies['Msambweni']->id],
             ['name' => 'Kinondo', 'constituency_id' => $constituencies['Msambweni']->id],
             ['name' => 'Ramisi', 'constituency_id' => $constituencies['Msambweni']->id],
 
             
             // Continue adding subcounties for all other constituencies
             // Ensure each subcounty is correctly linked to its constituency
 
             // **Example Structure**
             // ['name' => 'Subcounty Name', 'constituency_id' => $constituencies['Constituency Name']->id],
 
         ];

        Subcounty::insert($subcounties);
    }
}
