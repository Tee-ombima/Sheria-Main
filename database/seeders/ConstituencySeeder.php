<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Constituency;
use App\Models\Homecounty;

class ConstituencySeeder extends Seeder
{
    public function run()
    {
        $counties = [
            'Mombasa' => ['Changamwe', 'Jomvu', 'Kisauni', 'Nyali', 'Likoni', 'Mvita'],
            'Kwale' => ['Msambweni', 'Lunga Lunga', 'Matuga', 'Kinango'],
            'Kilifi' => ['Kilifi North', 'Kilifi South', 'Kaloleni', 'Rabai', 'Ganze', 'Malindi', 'Magarini'],
            'Tana River' => ['Garsen', 'Galole', 'Bura'],
            'Lamu' => ['Lamu East', 'Lamu West'],
            'Taita Taveta' => ['Taveta', 'Wundanyi', 'Mwatate', 'Voi'],
            'Garissa' => ['Garissa Township', 'Balambala', 'Lagdera', 'Dadaab', 'Fafi', 'Ijara'],
            'Wajir' => ['Wajir North', 'Wajir East', 'Tarbaj', 'Wajir West', 'Eldas', 'Wajir South'],
            'Mandera' => ['Mandera West', 'Banissa', 'Mandera North', 'Mandera South', 'Mandera East', 'Lafey'],
            'Marsabit' => ['Moyale', 'North Horr', 'Saku', 'Laisamis'],
            'Isiolo' => ['Isiolo North', 'Isiolo South'],
            'Meru' => ['Igembe South', 'Igembe Central', 'Igembe North', 'Tigania West', 'Tigania East', 'North Imenti', 'Buuri', 'Central Imenti', 'South Imenti'],
            'Tharaka-Nithi' => ['Maara', 'Chuka/Igambang\'ombe', 'Tharaka'],
            'Embu' => ['Manyatta', 'Runyenjes', 'Mbeere South', 'Mbeere North'],
            'Kitui' => ['Mwingi North', 'Mwingi West', 'Mwingi Central', 'Kitui West', 'Kitui Rural', 'Kitui Central', 'Kitui East', 'Kitui South'],
            'Machakos' => ['Masinga', 'Yatta', 'Kangundo', 'Matungulu', 'Kathiani', 'Mavoko', 'Machakos Town', 'Mwala'],
            'Makueni' => ['Mbooni', 'Kilome', 'Kaiti', 'Makueni', 'Kibwezi West', 'Kibwezi East'],
            'Nyandarua' => ['Kinangop', 'Kipipiri', 'Ol Kalou', 'Ol Jorok', 'Ndaragwa'],
            'Nyeri' => ['Tetu', 'Kieni', 'Mathira', 'Othaya', 'Mukurweini', 'Nyeri Town'],
            'Kirinyaga' => ['Mwea', 'Gichugu', 'Ndia', 'Kirinyaga Central'],
            'Murang\'a' => ['Kangema', 'Mathioya', 'Kiharu', 'Kigumo', 'Maragwa', 'Kandara', 'Gatanga'],
            'Kiambu' => ['Gatundu South', 'Gatundu North', 'Juja', 'Thika Town', 'Ruiru', 'Githunguri', 'Kiambu', 'Kiambaa', 'Kabete', 'Kikuyu', 'Limuru', 'Lari'],
            'Turkana' => ['Turkana North', 'Turkana West', 'Turkana Central', 'Loima', 'Turkana South', 'Turkana East'],
            'West Pokot' => ['Kapenguria', 'Sigor', 'Kacheliba', 'Pokot South'],
            'Samburu' => ['Samburu West', 'Samburu North', 'Samburu East'],
            'Trans Nzoia' => ['Kwanza', 'Endebess', 'Saboti', 'Kiminini', 'Cherangany'],
            'Uasin Gishu' => ['Soy', 'Turbo', 'Moiben', 'Ainabkoi', 'Kapseret', 'Kesses'],
            'Elgeyo-Marakwet' => ['Marakwet East', 'Marakwet West', 'Keiyo North', 'Keiyo South'],
            'Nandi' => ['Tinderet', 'Aldai', 'Nandi Hills', 'Chesumei', 'Emgwen', 'Mosop'],
            'Baringo' => ['Tiaty', 'Baringo North', 'Baringo Central', 'Baringo South', 'Mogotio', 'Eldama Ravine'],
            'Laikipia' => ['Laikipia West', 'Laikipia East', 'Laikipia North'],
            'Nakuru' => ['Molo', 'Njoro', 'Naivasha', 'Gilgil', 'Kuresoi South', 'Kuresoi North', 'Subukia', 'Rongai', 'Bahati', 'Nakuru Town West', 'Nakuru Town East'],
            'Narok' => ['Kilgoris', 'Emurua Dikirr', 'Narok North', 'Narok East', 'Narok South', 'Narok West'],
            'Kajiado' => ['Kajiado North', 'Kajiado Central', 'Kajiado East', 'Kajiado West', 'Kajiado South'],
            'Kericho' => ['Kipkelion East', 'Kipkelion West', 'Ainamoi', 'Bureti', 'Belgut', 'Soin/Sigowet'],
            'Bomet' => ['Sotik', 'Chepalungu', 'Bomet East', 'Bomet Central', 'Konoin'],
            'Kakamega' => ['Lugari', 'Likuyani', 'Malava', 'Lurambi', 'Navakholo', 'Mumias West', 'Mumias East', 'Matungu', 'Butere', 'Khwisero', 'Shinyalu', 'Ikolomani'],
            'Vihiga' => ['Vihiga', 'Sabatia', 'Hamisi', 'Luanda', 'Emuhaya'],
            'Bungoma' => ['Mt Elgon', 'Sirisia', 'Kabuchai', 'Bumula', 'Kanduyi', 'Webuye East', 'Webuye West', 'Kimilili', 'Tongaren'],
            'Busia' => ['Teso North', 'Teso South', 'Nambale', 'Matayos', 'Butula', 'Funyula', 'Budalangi'],
            'Siaya' => ['Ugenya', 'Ugunja', 'Alego Usonga', 'Gem', 'Bondo', 'Rarieda'],
            'Kisumu' => ['Kisumu East', 'Kisumu West', 'Kisumu Central', 'Seme', 'Nyando', 'Muhoroni', 'Nyakach'],
            'Homa Bay' => ['Kasipul', 'Kabondo Kasipul', 'Karachuonyo', 'Rangwe', 'Homa Bay Town', 'Ndhiwa', 'Mbita', 'Suba'],
            'Migori' => ['Rongo', 'Awendo', 'Suna East', 'Suna West', 'Uriri', 'Nyatike', 'Kuria West', 'Kuria East'],
            'Kisii' => ['Bonchari', 'South Mugirango', 'Bomachoge Borabu', 'Bobasi', 'Bomachoge Chache', 'Nyaribari Masaba', 'Nyaribari Chache', 'Kitutu Chache North', 'Kitutu Chache South'],
            'Nyamira' => ['West Mugirango', 'North Mugirango', 'Borabu', 'Kitutu Masaba'],
            'Nairobi' => ['Westlands', 'Dagoretti North', 'Dagoretti South', 'Lang\'ata', 'Kibra', 'Roysambu', 'Kasarani', 'Ruaraka', 'Embakasi South', 'Embakasi North', 'Embakasi Central', 'Embakasi East', 'Embakasi West', 'Makadara', 'Kamukunji', 'Starehe', 'Mathare'],
        ];

        foreach ($counties as $homecountyName => $constituencies) {
            $homecounty = Homecounty::firstWhere('name', $homecountyName);

            if ($homecounty) {
                foreach ($constituencies as $constituencyName) {
                    Constituency::firstOrCreate([
                        'name' => $constituencyName,
                        'homecounty_id' => $homecounty->id,
                    ]);
                }
            }
        }
    }
}
