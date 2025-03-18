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
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Westlands'],
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Dagoretti'],
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Langata'],
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Kibra'],
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Roysambu'],
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Kasarani'],
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Ruaraka'],
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Embakasi South'],
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Embakasi North'],
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Embakasi Central'],
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Embakasi East'],
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Embakasi West'],
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Makadara'],
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Kamukunji'],
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Starehe'],
            ['homecounty_id' => Homecounty::where('name', 'Nairobi')->first()->id, 'name' => 'Mathare'],

            // Mombasa SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Mombasa')->first()->id, 'name' => 'Changamwe'],
            ['homecounty_id' => Homecounty::where('name', 'Mombasa')->first()->id, 'name' => 'Jomvu'],
            ['homecounty_id' => Homecounty::where('name', 'Mombasa')->first()->id, 'name' => 'Kisauni'],
            ['homecounty_id' => Homecounty::where('name', 'Mombasa')->first()->id, 'name' => 'Nyali'],
            ['homecounty_id' => Homecounty::where('name', 'Mombasa')->first()->id, 'name' => 'Likoni'],
            ['homecounty_id' => Homecounty::where('name', 'Mombasa')->first()->id, 'name' => 'Mvita'],

            // Kisumu SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu East'],
            ['homecounty_id' => Homecounty::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu West'],
            ['homecounty_id' => Homecounty::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu Central'],
            ['homecounty_id' => Homecounty::where('name', 'Kisumu')->first()->id, 'name' => 'Seme'],
            ['homecounty_id' => Homecounty::where('name', 'Kisumu')->first()->id, 'name' => 'Nyando'],
            ['homecounty_id' => Homecounty::where('name', 'Kisumu')->first()->id, 'name' => 'Muhoroni'],
            ['homecounty_id' => Homecounty::where('name', 'Kisumu')->first()->id, 'name' => 'Nyakach'],

            // Kwale SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Kwale')->first()->id, 'name' => 'Matuga'],
            ['homecounty_id' => Homecounty::where('name', 'Kwale')->first()->id, 'name' => 'Msambweni'],
            ['homecounty_id' => Homecounty::where('name', 'Kwale')->first()->id, 'name' => 'Lunga Lunga'],
            ['homecounty_id' => Homecounty::where('name', 'Kwale')->first()->id, 'name' => 'Kinango'],

            // Kilifi SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Kilifi')->first()->id, 'name' => 'Kilifi South'],
            ['homecounty_id' => Homecounty::where('name', 'Kilifi')->first()->id, 'name' => 'Kilifi North'],
            ['homecounty_id' => Homecounty::where('name', 'Kilifi')->first()->id, 'name' => 'Kaloleni'],
            ['homecounty_id' => Homecounty::where('name', 'Kilifi')->first()->id, 'name' => 'Rabai'],
            ['homecounty_id' => Homecounty::where('name', 'Kilifi')->first()->id, 'name' => 'Ganze'],
            ['homecounty_id' => Homecounty::where('name', 'Kilifi')->first()->id, 'name' => 'Malindi'],
            ['homecounty_id' => Homecounty::where('name', 'Kilifi')->first()->id, 'name' => 'Magarini'],

            // Tana River SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Tana River')->first()->id, 'name' => 'Garsen'],
            ['homecounty_id' => Homecounty::where('name', 'Tana River')->first()->id, 'name' => 'Galole'],
            ['homecounty_id' => Homecounty::where('name', 'Tana River')->first()->id, 'name' => 'Bura'],

            // Lamu SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Lamu')->first()->id, 'name' => 'Lamu East'],
            ['homecounty_id' => Homecounty::where('name', 'Lamu')->first()->id, 'name' => 'Lamu West'],

            // Taita-Taveta SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Taita-Taveta')->first()->id, 'name' => 'Taveta'],
            ['homecounty_id' => Homecounty::where('name', 'Taita-Taveta')->first()->id, 'name' => 'Wundanyi'],
            ['homecounty_id' => Homecounty::where('name', 'Taita-Taveta')->first()->id, 'name' => 'Mwatate'],
            ['homecounty_id' => Homecounty::where('name', 'Taita-Taveta')->first()->id, 'name' => 'Voi'],

            // Garissa SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Garissa')->first()->id, 'name' => 'Garissa Township'],
            ['homecounty_id' => Homecounty::where('name', 'Garissa')->first()->id, 'name' => 'Balambala'],
            ['homecounty_id' => Homecounty::where('name', 'Garissa')->first()->id, 'name' => 'Lagdera'],
            ['homecounty_id' => Homecounty::where('name', 'Garissa')->first()->id, 'name' => 'Dadaab'],
            ['homecounty_id' => Homecounty::where('name', 'Garissa')->first()->id, 'name' => 'Fafi'],
            ['homecounty_id' => Homecounty::where('name', 'Garissa')->first()->id, 'name' => 'Ijara'],

            // Wajir SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Wajir')->first()->id, 'name' => 'Wajir North'],
            ['homecounty_id' => Homecounty::where('name', 'Wajir')->first()->id, 'name' => 'Wajir East'],
            ['homecounty_id' => Homecounty::where('name', 'Wajir')->first()->id, 'name' => 'Wajir South'],
            ['homecounty_id' => Homecounty::where('name', 'Wajir')->first()->id, 'name' => 'Wajir West'],
            ['homecounty_id' => Homecounty::where('name', 'Wajir')->first()->id, 'name' => 'Tarbaj'],
            ['homecounty_id' => Homecounty::where('name', 'Wajir')->first()->id, 'name' => 'Eldas'],

            // Mandera SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Mandera')->first()->id, 'name' => 'Mandera North'],
            ['homecounty_id' => Homecounty::where('name', 'Mandera')->first()->id, 'name' => 'Mandera West'],
            ['homecounty_id' => Homecounty::where('name', 'Mandera')->first()->id, 'name' => 'Mandera East'],
            ['homecounty_id' => Homecounty::where('name', 'Mandera')->first()->id, 'name' => 'Mandera South'],
            ['homecounty_id' => Homecounty::where('name', 'Mandera')->first()->id, 'name' => 'Banissa'],
            ['homecounty_id' => Homecounty::where('name', 'Mandera')->first()->id, 'name' => 'Lafey'],

            // Marsabit SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Marsabit')->first()->id, 'name' => 'Moyale'],
            ['homecounty_id' => Homecounty::where('name', 'Marsabit')->first()->id, 'name' => 'North Horr'],
            ['homecounty_id' => Homecounty::where('name', 'Marsabit')->first()->id, 'name' => 'Saku'],
            ['homecounty_id' => Homecounty::where('name', 'Marsabit')->first()->id, 'name' => 'Laisamis'],

            // Isiolo SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Isiolo')->first()->id, 'name' => 'Isiolo North'],
            ['homecounty_id' => Homecounty::where('name', 'Isiolo')->first()->id, 'name' => 'Isiolo South'],

            // Meru SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Meru')->first()->id, 'name' => 'Imenti North'],
            ['homecounty_id' => Homecounty::where('name', 'Meru')->first()->id, 'name' => 'Imenti South'],
            ['homecounty_id' => Homecounty::where('name', 'Meru')->first()->id, 'name' => 'Igembe South'],
            ['homecounty_id' => Homecounty::where('name', 'Meru')->first()->id, 'name' => 'Igembe Central'],
            ['homecounty_id' => Homecounty::where('name', 'Meru')->first()->id, 'name' => 'Igembe North'],
            ['homecounty_id' => Homecounty::where('name', 'Meru')->first()->id, 'name' => 'Tigania West'],
            ['homecounty_id' => Homecounty::where('name', 'Meru')->first()->id, 'name' => 'Tigania East'],
            ['homecounty_id' => Homecounty::where('name', 'Meru')->first()->id, 'name' => 'Buuri'],

            // Tharaka-Nithi SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Tharaka-Nithi')->first()->id, 'name' => 'Tharaka South'],
            ['homecounty_id' => Homecounty::where('name', 'Tharaka-Nithi')->first()->id, 'name' => 'Tharaka North'],
            ['homecounty_id' => Homecounty::where('name', 'Tharaka-Nithi')->first()->id, 'name' => 'Chuka/Igambang\'ombe'],
            ['homecounty_id' => Homecounty::where('name', 'Tharaka-Nithi')->first()->id, 'name' => 'Maara'],

            // Embu SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Embu')->first()->id, 'name' => 'Manyatta'],
            ['homecounty_id' => Homecounty::where('name', 'Embu')->first()->id, 'name' => 'Runyenjes'],
            ['homecounty_id' => Homecounty::where('name', 'Embu')->first()->id, 'name' => 'Mbeere South'],
            ['homecounty_id' => Homecounty::where('name', 'Embu')->first()->id, 'name' => 'Mbeere North'],

            // Kitui SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Kitui')->first()->id, 'name' => 'Kitui West'],
            ['homecounty_id' => Homecounty::where('name', 'Kitui')->first()->id, 'name' => 'Kitui Central'],
            ['homecounty_id' => Homecounty::where('name', 'Kitui')->first()->id, 'name' => 'Kitui Rural'],
            ['homecounty_id' => Homecounty::where('name', 'Kitui')->first()->id, 'name' => 'Kitui South'],
            ['homecounty_id' => Homecounty::where('name', 'Kitui')->first()->id, 'name' => 'Kitui East'],
            ['homecounty_id' => Homecounty::where('name', 'Kitui')->first()->id, 'name' => 'Mwingi North'],
            ['homecounty_id' => Homecounty::where('name', 'Kitui')->first()->id, 'name' => 'Mwingi West'],
            ['homecounty_id' => Homecounty::where('name', 'Kitui')->first()->id, 'name' => 'Mwingi Central'],

            // Machakos SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Machakos')->first()->id, 'name' => 'Machakos Town'],
            ['homecounty_id' => Homecounty::where('name', 'Machakos')->first()->id, 'name' => 'Mavoko'],
            ['homecounty_id' => Homecounty::where('name', 'Machakos')->first()->id, 'name' => 'Mwala'],
            ['homecounty_id' => Homecounty::where('name', 'Machakos')->first()->id, 'name' => 'Yatta'],
            ['homecounty_id' => Homecounty::where('name', 'Machakos')->first()->id, 'name' => 'Kangundo'],
            ['homecounty_id' => Homecounty::where('name', 'Machakos')->first()->id, 'name' => 'Matungulu'],
            ['homecounty_id' => Homecounty::where('name', 'Machakos')->first()->id, 'name' => 'Kathiani'],

            // Makueni SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Makueni')->first()->id, 'name' => 'Makueni'],
            ['homecounty_id' => Homecounty::where('name', 'Makueni')->first()->id, 'name' => 'Kibwezi East'],
            ['homecounty_id' => Homecounty::where('name', 'Makueni')->first()->id, 'name' => 'Kibwezi West'],
            ['homecounty_id' => Homecounty::where('name', 'Makueni')->first()->id, 'name' => 'Mbooni'],
            ['homecounty_id' => Homecounty::where('name', 'Makueni')->first()->id, 'name' => 'Kilome'],
            ['homecounty_id' => Homecounty::where('name', 'Makueni')->first()->id, 'name' => 'Kaiti'],
            ['homecounty_id' => Homecounty::where('name', 'Makueni')->first()->id, 'name' => 'Nguu/Masumba'],

            // Nyandarua SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Nyandarua')->first()->id, 'name' => 'Kinangop'],
            ['homecounty_id' => Homecounty::where('name', 'Nyandarua')->first()->id, 'name' => 'Kipipiri'],
            ['homecounty_id' => Homecounty::where('name', 'Nyandarua')->first()->id, 'name' => 'Ol Kalou'],
            ['homecounty_id' => Homecounty::where('name', 'Nyandarua')->first()->id, 'name' => 'Ol Jorok'],
            ['homecounty_id' => Homecounty::where('name', 'Nyandarua')->first()->id, 'name' => 'Ndaragwa'],

            // Nyeri SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Nyeri')->first()->id, 'name' => 'Tetu'],
            ['homecounty_id' => Homecounty::where('name', 'Nyeri')->first()->id, 'name' => 'Kieni'],
            ['homecounty_id' => Homecounty::where('name', 'Nyeri')->first()->id, 'name' => 'Mathira'],
            ['homecounty_id' => Homecounty::where('name', 'Nyeri')->first()->id, 'name' => 'Othaya'],
            ['homecounty_id' => Homecounty::where('name', 'Nyeri')->first()->id, 'name' => 'Mukurweini'],
            ['homecounty_id' => Homecounty::where('name', 'Nyeri')->first()->id, 'name' => 'Nyeri Town'],

            // Kirinyaga SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Kirinyaga')->first()->id, 'name' => 'Kirinyaga Central'],
            ['homecounty_id' => Homecounty::where('name', 'Kirinyaga')->first()->id, 'name' => 'Kirinyaga East'],
            ['homecounty_id' => Homecounty::where('name', 'Kirinyaga')->first()->id, 'name' => 'Kirinyaga West'],
            ['homecounty_id' => Homecounty::where('name', 'Kirinyaga')->first()->id, 'name' => 'Mwea'],
            ['homecounty_id' => Homecounty::where('name', 'Kirinyaga')->first()->id, 'name' => 'Gichugu'],

            // Murang'a SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Murang\'a')->first()->id, 'name' => 'Kandara'],
            ['homecounty_id' => Homecounty::where('name', 'Murang\'a')->first()->id, 'name' => 'Gatanga'],
            ['homecounty_id' => Homecounty::where('name', 'Murang\'a')->first()->id, 'name' => 'Kigumo'],
            ['homecounty_id' => Homecounty::where('name', 'Murang\'a')->first()->id, 'name' => 'Kahuro'],
            ['homecounty_id' => Homecounty::where('name', 'Murang\'a')->first()->id, 'name' => 'Kangema'],
            ['homecounty_id' => Homecounty::where('name', 'Murang\'a')->first()->id, 'name' => 'Mathioya'],
            ['homecounty_id' => Homecounty::where('name', 'Murang\'a')->first()->id, 'name' => 'Maragua'],

            // Kiambu SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Kiambu')->first()->id, 'name' => 'Gatundu South'],
            ['homecounty_id' => Homecounty::where('name', 'Kiambu')->first()->id, 'name' => 'Gatundu North'],
            ['homecounty_id' => Homecounty::where('name', 'Kiambu')->first()->id, 'name' => 'Juja'],
            ['homecounty_id' => Homecounty::where('name', 'Kiambu')->first()->id, 'name' => 'Thika Town'],
            ['homecounty_id' => Homecounty::where('name', 'Kiambu')->first()->id, 'name' => 'Ruiru'],
            ['homecounty_id' => Homecounty::where('name', 'Kiambu')->first()->id, 'name' => 'Githunguri'],
            ['homecounty_id' => Homecounty::where('name', 'Kiambu')->first()->id, 'name' => 'Kiambu'],
            ['homecounty_id' => Homecounty::where('name', 'Kiambu')->first()->id, 'name' => 'Kiambaa'],
            ['homecounty_id' => Homecounty::where('name', 'Kiambu')->first()->id, 'name' => 'Kabete'],
            ['homecounty_id' => Homecounty::where('name', 'Kiambu')->first()->id, 'name' => 'Kikuyu'],
            ['homecounty_id' => Homecounty::where('name', 'Kiambu')->first()->id, 'name' => 'Limuru'],
            ['homecounty_id' => Homecounty::where('name', 'Kiambu')->first()->id, 'name' => 'Lari'],

            // Turkana SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Turkana')->first()->id, 'name' => 'Turkana Central'],
            ['homecounty_id' => Homecounty::where('name', 'Turkana')->first()->id, 'name' => 'Turkana East'],
            ['homecounty_id' => Homecounty::where('name', 'Turkana')->first()->id, 'name' => 'Turkana North'],
            ['homecounty_id' => Homecounty::where('name', 'Turkana')->first()->id, 'name' => 'Turkana South'],
            ['homecounty_id' => Homecounty::where('name', 'Turkana')->first()->id, 'name' => 'Loima'],
            ['homecounty_id' => Homecounty::where('name', 'Turkana')->first()->id, 'name' => 'Turkana West'],

            // West Pokot SubCounties
            ['homecounty_id' => Homecounty::where('name', 'West Pokot')->first()->id, 'name' => 'Kapenguria'],
            ['homecounty_id' => Homecounty::where('name', 'West Pokot')->first()->id, 'name' => 'Sigor'],
            ['homecounty_id' => Homecounty::where('name', 'West Pokot')->first()->id, 'name' => 'Kacheliba'],
            ['homecounty_id' => Homecounty::where('name', 'West Pokot')->first()->id, 'name' => 'Pokot South'],

            // Samburu SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Samburu')->first()->id, 'name' => 'Samburu East'],
            ['homecounty_id' => Homecounty::where('name', 'Samburu')->first()->id, 'name' => 'Samburu North'],
            ['homecounty_id' => Homecounty::where('name', 'Samburu')->first()->id, 'name' => 'Samburu West'],

            // Trans Nzoia SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Trans Nzoia')->first()->id, 'name' => 'Kiminini'],
            ['homecounty_id' => Homecounty::where('name', 'Trans Nzoia')->first()->id, 'name' => 'Saboti'],
            ['homecounty_id' => Homecounty::where('name', 'Trans Nzoia')->first()->id, 'name' => 'Cherangany'],
            ['homecounty_id' => Homecounty::where('name', 'Trans Nzoia')->first()->id, 'name' => 'Endebess'],
            ['homecounty_id' => Homecounty::where('name', 'Trans Nzoia')->first()->id, 'name' => 'Kwanza'],

            // Uasin Gishu SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Uasin Gishu')->first()->id, 'name' => 'Ainabkoi'],
            ['homecounty_id' => Homecounty::where('name', 'Uasin Gishu')->first()->id, 'name' => 'Kapseret'],
            ['homecounty_id' => Homecounty::where('name', 'Uasin Gishu')->first()->id, 'name' => 'Kesses'],
            ['homecounty_id' => Homecounty::where('name', 'Uasin Gishu')->first()->id, 'name' => 'Moiben'],
            ['homecounty_id' => Homecounty::where('name', 'Uasin Gishu')->first()->id, 'name' => 'Soy'],
            ['homecounty_id' => Homecounty::where('name', 'Uasin Gishu')->first()->id, 'name' => 'Turbo'],

            // Elgeyo-Marakwet SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Elgeyo-Marakwet')->first()->id, 'name' => 'Keiyo North'],
            ['homecounty_id' => Homecounty::where('name', 'Elgeyo-Marakwet')->first()->id, 'name' => 'Keiyo South'],
            ['homecounty_id' => Homecounty::where('name', 'Elgeyo-Marakwet')->first()->id, 'name' => 'Marakwet East'],
            ['homecounty_id' => Homecounty::where('name', 'Elgeyo-Marakwet')->first()->id, 'name' => 'Marakwet West'],

            // Nandi SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Nandi')->first()->id, 'name' => 'Chesumei'],
            ['homecounty_id' => Homecounty::where('name', 'Nandi')->first()->id, 'name' => 'Emgwen'],
            ['homecounty_id' => Homecounty::where('name', 'Nandi')->first()->id, 'name' => 'Mosop'],
            ['homecounty_id' => Homecounty::where('name', 'Nandi')->first()->id, 'name' => 'Tinderet'],

            // Baringo SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Baringo')->first()->id, 'name' => 'Baringo Central'],
            ['homecounty_id' => Homecounty::where('name', 'Baringo')->first()->id, 'name' => 'Baringo North'],
            ['homecounty_id' => Homecounty::where('name', 'Baringo')->first()->id, 'name' => 'Baringo South'],
            ['homecounty_id' => Homecounty::where('name', 'Baringo')->first()->id, 'name' => 'Eldama Ravine'],
            ['homecounty_id' => Homecounty::where('name', 'Baringo')->first()->id, 'name' => 'Mogotio'],
            ['homecounty_id' => Homecounty::where('name', 'Baringo')->first()->id, 'name' => 'Tiaty'],

            // Laikipia SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Laikipia')->first()->id, 'name' => 'Laikipia Central'],
            ['homecounty_id' => Homecounty::where('name', 'Laikipia')->first()->id, 'name' => 'Laikipia East'],
            ['homecounty_id' => Homecounty::where('name', 'Laikipia')->first()->id, 'name' => 'Laikipia North'],
            ['homecounty_id' => Homecounty::where('name', 'Laikipia')->first()->id, 'name' => 'Laikipia West'],
            ['homecounty_id' => Homecounty::where('name', 'Laikipia')->first()->id, 'name' => 'Nyahururu'],

            // Nakuru SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Nakuru')->first()->id, 'name' => 'Nakuru Town East'],
            ['homecounty_id' => Homecounty::where('name', 'Nakuru')->first()->id, 'name' => 'Nakuru Town West'],
            ['homecounty_id' => Homecounty::where('name', 'Nakuru')->first()->id, 'name' => 'Molo'],
            ['homecounty_id' => Homecounty::where('name', 'Nakuru')->first()->id, 'name' => 'Njoro'],
            ['homecounty_id' => Homecounty::where('name', 'Nakuru')->first()->id, 'name' => 'Naivasha'],
            ['homecounty_id' => Homecounty::where('name', 'Nakuru')->first()->id, 'name' => 'Gilgil'],
            ['homecounty_id' => Homecounty::where('name', 'Nakuru')->first()->id, 'name' => 'Kuresoi South'],
            ['homecounty_id' => Homecounty::where('name', 'Nakuru')->first()->id, 'name' => 'Kuresoi North'],
            ['homecounty_id' => Homecounty::where('name', 'Nakuru')->first()->id, 'name' => 'Subukia'],
            ['homecounty_id' => Homecounty::where('name', 'Nakuru')->first()->id, 'name' => 'Rongai'],
            ['homecounty_id' => Homecounty::where('name', 'Nakuru')->first()->id, 'name' => 'Bahati'],

            // Narok SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Narok')->first()->id, 'name' => 'Narok North'],
            ['homecounty_id' => Homecounty::where('name', 'Narok')->first()->id, 'name' => 'Narok South'],
            ['homecounty_id' => Homecounty::where('name', 'Narok')->first()->id, 'name' => 'Narok East'],
            ['homecounty_id' => Homecounty::where('name', 'Narok')->first()->id, 'name' => 'Narok West'],
            ['homecounty_id' => Homecounty::where('name', 'Narok')->first()->id, 'name' => 'Transmara East'],
            ['homecounty_id' => Homecounty::where('name', 'Narok')->first()->id, 'name' => 'Transmara West'],

            // Kajiado SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Kajiado')->first()->id, 'name' => 'Kajiado Central'],
            ['homecounty_id' => Homecounty::where('name', 'Kajiado')->first()->id, 'name' => 'Kajiado North'],
            ['homecounty_id' => Homecounty::where('name', 'Kajiado')->first()->id, 'name' => 'Kajiado South'],
            ['homecounty_id' => Homecounty::where('name', 'Kajiado')->first()->id, 'name' => 'Kajiado East'],
            ['homecounty_id' => Homecounty::where('name', 'Kajiado')->first()->id, 'name' => 'Kajiado West'],

            // Kericho SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Kericho')->first()->id, 'name' => 'Ainamoi'],
            ['homecounty_id' => Homecounty::where('name', 'Kericho')->first()->id, 'name' => 'Belgut'],
            ['homecounty_id' => Homecounty::where('name', 'Kericho')->first()->id, 'name' => 'Bureti'],
            ['homecounty_id' => Homecounty::where('name', 'Kericho')->first()->id, 'name' => 'Kipkelion East'],
            ['homecounty_id' => Homecounty::where('name', 'Kericho')->first()->id, 'name' => 'Kipkelion West'],
            ['homecounty_id' => Homecounty::where('name', 'Kericho')->first()->id, 'name' => 'Sigowet/Soin'],

            // Bomet SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Bomet')->first()->id, 'name' => 'Bomet Central'],
            ['homecounty_id' => Homecounty::where('name', 'Bomet')->first()->id, 'name' => 'Bomet East'],
            ['homecounty_id' => Homecounty::where('name', 'Bomet')->first()->id, 'name' => 'Chepalungu'],
            ['homecounty_id' => Homecounty::where('name', 'Bomet')->first()->id, 'name' => 'Konoin'],
            ['homecounty_id' => Homecounty::where('name', 'Bomet')->first()->id, 'name' => 'Sotik'],

            // Kakamega SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Kakamega')->first()->id, 'name' => 'Butere'],
            ['homecounty_id' => Homecounty::where('name', 'Kakamega')->first()->id, 'name' => 'Kakamega Central'],
            ['homecounty_id' => Homecounty::where('name', 'Kakamega')->first()->id, 'name' => 'Kakamega East'],
            ['homecounty_id' => Homecounty::where('name', 'Kakamega')->first()->id, 'name' => 'Kakamega North'],
            ['homecounty_id' => Homecounty::where('name', 'Kakamega')->first()->id, 'name' => 'Kakamega South'],
            ['homecounty_id' => Homecounty::where('name', 'Kakamega')->first()->id, 'name' => 'Khwisero'],
            ['homecounty_id' => Homecounty::where('name', 'Kakamega')->first()->id, 'name' => 'Likuyani'],
            ['homecounty_id' => Homecounty::where('name', 'Kakamega')->first()->id, 'name' => 'Lugari'],
            ['homecounty_id' => Homecounty::where('name', 'Kakamega')->first()->id, 'name' => 'Matungu'],
            ['homecounty_id' => Homecounty::where('name', 'Kakamega')->first()->id, 'name' => 'Mumias East'],
            ['homecounty_id' => Homecounty::where('name', 'Kakamega')->first()->id, 'name' => 'Mumias West'],
            ['homecounty_id' => Homecounty::where('name', 'Kakamega')->first()->id, 'name' => 'Navakholo'],

            // Vihiga SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Vihiga')->first()->id, 'name' => 'Emuhaya'],
            ['homecounty_id' => Homecounty::where('name', 'Vihiga')->first()->id, 'name' => 'Hamisi'],
            ['homecounty_id' => Homecounty::where('name', 'Vihiga')->first()->id, 'name' => 'Luanda'],
            ['homecounty_id' => Homecounty::where('name', 'Vihiga')->first()->id, 'name' => 'Sabatia'],
            ['homecounty_id' => Homecounty::where('name', 'Vihiga')->first()->id, 'name' => 'Vihiga'],

            // Bungoma SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Bungoma')->first()->id, 'name' => 'Bungoma Central'],
            ['homecounty_id' => Homecounty::where('name', 'Bungoma')->first()->id, 'name' => 'Bungoma East'],
            ['homecounty_id' => Homecounty::where('name', 'Bungoma')->first()->id, 'name' => 'Bungoma North'],
            ['homecounty_id' => Homecounty::where('name', 'Bungoma')->first()->id, 'name' => 'Bungoma South'],
            ['homecounty_id' => Homecounty::where('name', 'Bungoma')->first()->id, 'name' => 'Bungoma West'],
            ['homecounty_id' => Homecounty::where('name', 'Bungoma')->first()->id, 'name' => 'Cheptais'],
            ['homecounty_id' => Homecounty::where('name', 'Bungoma')->first()->id, 'name' => 'Kimilili'],
            ['homecounty_id' => Homecounty::where('name', 'Bungoma')->first()->id, 'name' => 'Mt. Elgon'],
            ['homecounty_id' => Homecounty::where('name', 'Bungoma')->first()->id, 'name' => 'Sirisia'],
            ['homecounty_id' => Homecounty::where('name', 'Bungoma')->first()->id, 'name' => 'Tongaren'],
            ['homecounty_id' => Homecounty::where('name', 'Bungoma')->first()->id, 'name' => 'Webuye East'],
            ['homecounty_id' => Homecounty::where('name', 'Bungoma')->first()->id, 'name' => 'Webuye West'],

            // Busia SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Busia')->first()->id, 'name' => 'Bunyala'],
            ['homecounty_id' => Homecounty::where('name', 'Busia')->first()->id, 'name' => 'Busia'],
            ['homecounty_id' => Homecounty::where('name', 'Busia')->first()->id, 'name' => 'Butula'],
            ['homecounty_id' => Homecounty::where('name', 'Busia')->first()->id, 'name' => 'Funyula'],
            ['homecounty_id' => Homecounty::where('name', 'Busia')->first()->id, 'name' => 'Nambale'],
            ['homecounty_id' => Homecounty::where('name', 'Busia')->first()->id, 'name' => 'Teso North'],
            ['homecounty_id' => Homecounty::where('name', 'Busia')->first()->id, 'name' => 'Teso South'],

            // Siaya SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Siaya')->first()->id, 'name' => 'Alego Usonga'],
            ['homecounty_id' => Homecounty::where('name', 'Siaya')->first()->id, 'name' => 'Bondo'],
            ['homecounty_id' => Homecounty::where('name', 'Siaya')->first()->id, 'name' => 'Gem'],
            ['homecounty_id' => Homecounty::where('name', 'Siaya')->first()->id, 'name' => 'Rarieda'],
            ['homecounty_id' => Homecounty::where('name', 'Siaya')->first()->id, 'name' => 'Ugenya'],
            ['homecounty_id' => Homecounty::where('name', 'Siaya')->first()->id, 'name' => 'Ugunja'],

            // Kisumu SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu East'],
            ['homecounty_id' => Homecounty::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu West'],
            ['homecounty_id' => Homecounty::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu Central'],
            ['homecounty_id' => Homecounty::where('name', 'Kisumu')->first()->id, 'name' => 'Seme'],
            ['homecounty_id' => Homecounty::where('name', 'Kisumu')->first()->id, 'name' => 'Nyando'],
            ['homecounty_id' => Homecounty::where('name', 'Kisumu')->first()->id, 'name' => 'Muhoroni'],
            ['homecounty_id' => Homecounty::where('name', 'Kisumu')->first()->id, 'name' => 'Nyakach'],

            // Homa Bay SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Homa Bay')->first()->id, 'name' => 'Homa Bay Town'],
            ['homecounty_id' => Homecounty::where('name', 'Homa Bay')->first()->id, 'name' => 'Kabondo Kasipul'],
            ['homecounty_id' => Homecounty::where('name', 'Homa Bay')->first()->id, 'name' => 'Karachuonyo'],
            ['homecounty_id' => Homecounty::where('name', 'Homa Bay')->first()->id, 'name' => 'Kasipul'],
            ['homecounty_id' => Homecounty::where('name', 'Homa Bay')->first()->id, 'name' => 'Mbita'],
            ['homecounty_id' => Homecounty::where('name', 'Homa Bay')->first()->id, 'name' => 'Ndhiwa'],
            ['homecounty_id' => Homecounty::where('name', 'Homa Bay')->first()->id, 'name' => 'Rangwe'],
            ['homecounty_id' => Homecounty::where('name', 'Homa Bay')->first()->id, 'name' => 'Suba'],

            // Migori SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Migori')->first()->id, 'name' => 'Awendo'],
            ['homecounty_id' => Homecounty::where('name', 'Migori')->first()->id, 'name' => 'Kuria East'],
            ['homecounty_id' => Homecounty::where('name', 'Migori')->first()->id, 'name' => 'Kuria West'],
            ['homecounty_id' => Homecounty::where('name', 'Migori')->first()->id, 'name' => 'Nyatike'],
            ['homecounty_id' => Homecounty::where('name', 'Migori')->first()->id, 'name' => 'Rongo'],
            ['homecounty_id' => Homecounty::where('name', 'Migori')->first()->id, 'name' => 'Suna East'],
            ['homecounty_id' => Homecounty::where('name', 'Migori')->first()->id, 'name' => 'Suna West'],
            ['homecounty_id' => Homecounty::where('name', 'Migori')->first()->id, 'name' => 'Uriri'],

            // Kisii SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Kisii')->first()->id, 'name' => 'Bobasi'],
            ['homecounty_id' => Homecounty::where('name', 'Kisii')->first()->id, 'name' => 'Bomachoge Borabu'],
            ['homecounty_id' => Homecounty::where('name', 'Kisii')->first()->id, 'name' => 'Bomachoge Chache'],
            ['homecounty_id' => Homecounty::where('name', 'Kisii')->first()->id, 'name' => 'Bonchari'],
            ['homecounty_id' => Homecounty::where('name', 'Kisii')->first()->id, 'name' => 'Kitutu Chache North'],
            ['homecounty_id' => Homecounty::where('name', 'Kisii')->first()->id, 'name' => 'Kitutu Chache South'],
            ['homecounty_id' => Homecounty::where('name', 'Kisii')->first()->id, 'name' => 'Nyaribari Chache'],
            ['homecounty_id' => Homecounty::where('name', 'Kisii')->first()->id, 'name' => 'Nyaribari Masaba'],
            ['homecounty_id' => Homecounty::where('name', 'Kisii')->first()->id, 'name' => 'South Mugirango'],

            // Nyamira SubCounties
            ['homecounty_id' => Homecounty::where('name', 'Nyamira')->first()->id, 'name' => 'Borabu'],
            ['homecounty_id' => Homecounty::where('name', 'Nyamira')->first()->id, 'name' => 'Manga'],
            ['homecounty_id' => Homecounty::where('name', 'Nyamira')->first()->id, 'name' => 'Masaba North'],
            ['homecounty_id' => Homecounty::where('name', 'Nyamira')->first()->id, 'name' => 'Nyamira North'],
            ['homecounty_id' => Homecounty::where('name', 'Nyamira')->first()->id, 'name' => 'Nyamira South'],
 
         ];

        Subcounty::insert($subcounties);
    }
}
