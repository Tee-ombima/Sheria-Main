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
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Dagoretti'],
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Langata'],
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Kibra'],
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Roysambu'],
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Kasarani'],
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Ruaraka'],
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Embakasi South'],
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Embakasi North'],
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Embakasi Central'],
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Embakasi East'],
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Embakasi West'],
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Makadara'],
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Kamukunji'],
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Starehe'],
            ['county_id' => Countypp::where('name', 'Nairobi')->first()->id, 'name' => 'Mathare'],

            // Mombasa SubCounties
            ['county_id' => Countypp::where('name', 'Mombasa')->first()->id, 'name' => 'Changamwe'],
            ['county_id' => Countypp::where('name', 'Mombasa')->first()->id, 'name' => 'Jomvu'],
            ['county_id' => Countypp::where('name', 'Mombasa')->first()->id, 'name' => 'Kisauni'],
            ['county_id' => Countypp::where('name', 'Mombasa')->first()->id, 'name' => 'Nyali'],
            ['county_id' => Countypp::where('name', 'Mombasa')->first()->id, 'name' => 'Likoni'],
            ['county_id' => Countypp::where('name', 'Mombasa')->first()->id, 'name' => 'Mvita'],

            // Kisumu SubCounties
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu East'],
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu West'],
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu Central'],
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Seme'],
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Nyando'],
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Muhoroni'],
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Nyakach'],

            // Kwale SubCounties
            ['county_id' => Countypp::where('name', 'Kwale')->first()->id, 'name' => 'Matuga'],
            ['county_id' => Countypp::where('name', 'Kwale')->first()->id, 'name' => 'Msambweni'],
            ['county_id' => Countypp::where('name', 'Kwale')->first()->id, 'name' => 'Lunga Lunga'],
            ['county_id' => Countypp::where('name', 'Kwale')->first()->id, 'name' => 'Kinango'],

            // Kilifi SubCounties
            ['county_id' => Countypp::where('name', 'Kilifi')->first()->id, 'name' => 'Kilifi South'],
            ['county_id' => Countypp::where('name', 'Kilifi')->first()->id, 'name' => 'Kilifi North'],
            ['county_id' => Countypp::where('name', 'Kilifi')->first()->id, 'name' => 'Kaloleni'],
            ['county_id' => Countypp::where('name', 'Kilifi')->first()->id, 'name' => 'Rabai'],
            ['county_id' => Countypp::where('name', 'Kilifi')->first()->id, 'name' => 'Ganze'],
            ['county_id' => Countypp::where('name', 'Kilifi')->first()->id, 'name' => 'Malindi'],
            ['county_id' => Countypp::where('name', 'Kilifi')->first()->id, 'name' => 'Magarini'],

            // Tana River SubCounties
            ['county_id' => Countypp::where('name', 'Tana River')->first()->id, 'name' => 'Garsen'],
            ['county_id' => Countypp::where('name', 'Tana River')->first()->id, 'name' => 'Galole'],
            ['county_id' => Countypp::where('name', 'Tana River')->first()->id, 'name' => 'Bura'],

            // Lamu SubCounties
            ['county_id' => Countypp::where('name', 'Lamu')->first()->id, 'name' => 'Lamu East'],
            ['county_id' => Countypp::where('name', 'Lamu')->first()->id, 'name' => 'Lamu West'],

            // Taita-Taveta SubCounties
            ['county_id' => Countypp::where('name', 'Taita-Taveta')->first()->id, 'name' => 'Taveta'],
            ['county_id' => Countypp::where('name', 'Taita-Taveta')->first()->id, 'name' => 'Wundanyi'],
            ['county_id' => Countypp::where('name', 'Taita-Taveta')->first()->id, 'name' => 'Mwatate'],
            ['county_id' => Countypp::where('name', 'Taita-Taveta')->first()->id, 'name' => 'Voi'],

            // Garissa SubCounties
            ['county_id' => Countypp::where('name', 'Garissa')->first()->id, 'name' => 'Garissa Township'],
            ['county_id' => Countypp::where('name', 'Garissa')->first()->id, 'name' => 'Balambala'],
            ['county_id' => Countypp::where('name', 'Garissa')->first()->id, 'name' => 'Lagdera'],
            ['county_id' => Countypp::where('name', 'Garissa')->first()->id, 'name' => 'Dadaab'],
            ['county_id' => Countypp::where('name', 'Garissa')->first()->id, 'name' => 'Fafi'],
            ['county_id' => Countypp::where('name', 'Garissa')->first()->id, 'name' => 'Ijara'],

            // Wajir SubCounties
            ['county_id' => Countypp::where('name', 'Wajir')->first()->id, 'name' => 'Wajir North'],
            ['county_id' => Countypp::where('name', 'Wajir')->first()->id, 'name' => 'Wajir East'],
            ['county_id' => Countypp::where('name', 'Wajir')->first()->id, 'name' => 'Wajir South'],
            ['county_id' => Countypp::where('name', 'Wajir')->first()->id, 'name' => 'Wajir West'],
            ['county_id' => Countypp::where('name', 'Wajir')->first()->id, 'name' => 'Tarbaj'],
            ['county_id' => Countypp::where('name', 'Wajir')->first()->id, 'name' => 'Eldas'],

            // Mandera SubCounties
            ['county_id' => Countypp::where('name', 'Mandera')->first()->id, 'name' => 'Mandera North'],
            ['county_id' => Countypp::where('name', 'Mandera')->first()->id, 'name' => 'Mandera West'],
            ['county_id' => Countypp::where('name', 'Mandera')->first()->id, 'name' => 'Mandera East'],
            ['county_id' => Countypp::where('name', 'Mandera')->first()->id, 'name' => 'Mandera South'],
            ['county_id' => Countypp::where('name', 'Mandera')->first()->id, 'name' => 'Banissa'],
            ['county_id' => Countypp::where('name', 'Mandera')->first()->id, 'name' => 'Lafey'],

            // Marsabit SubCounties
            ['county_id' => Countypp::where('name', 'Marsabit')->first()->id, 'name' => 'Moyale'],
            ['county_id' => Countypp::where('name', 'Marsabit')->first()->id, 'name' => 'North Horr'],
            ['county_id' => Countypp::where('name', 'Marsabit')->first()->id, 'name' => 'Saku'],
            ['county_id' => Countypp::where('name', 'Marsabit')->first()->id, 'name' => 'Laisamis'],

            // Isiolo SubCounties
            ['county_id' => Countypp::where('name', 'Isiolo')->first()->id, 'name' => 'Isiolo North'],
            ['county_id' => Countypp::where('name', 'Isiolo')->first()->id, 'name' => 'Isiolo South'],

            // Meru SubCounties
            ['county_id' => Countypp::where('name', 'Meru')->first()->id, 'name' => 'Imenti North'],
            ['county_id' => Countypp::where('name', 'Meru')->first()->id, 'name' => 'Imenti South'],
            ['county_id' => Countypp::where('name', 'Meru')->first()->id, 'name' => 'Igembe South'],
            ['county_id' => Countypp::where('name', 'Meru')->first()->id, 'name' => 'Igembe Central'],
            ['county_id' => Countypp::where('name', 'Meru')->first()->id, 'name' => 'Igembe North'],
            ['county_id' => Countypp::where('name', 'Meru')->first()->id, 'name' => 'Tigania West'],
            ['county_id' => Countypp::where('name', 'Meru')->first()->id, 'name' => 'Tigania East'],
            ['county_id' => Countypp::where('name', 'Meru')->first()->id, 'name' => 'Buuri'],

            // Tharaka-Nithi SubCounties
            ['county_id' => Countypp::where('name', 'Tharaka-Nithi')->first()->id, 'name' => 'Tharaka South'],
            ['county_id' => Countypp::where('name', 'Tharaka-Nithi')->first()->id, 'name' => 'Tharaka North'],
            ['county_id' => Countypp::where('name', 'Tharaka-Nithi')->first()->id, 'name' => 'Chuka/Igambang\'ombe'],
            ['county_id' => Countypp::where('name', 'Tharaka-Nithi')->first()->id, 'name' => 'Maara'],

            // Embu SubCounties
            ['county_id' => Countypp::where('name', 'Embu')->first()->id, 'name' => 'Manyatta'],
            ['county_id' => Countypp::where('name', 'Embu')->first()->id, 'name' => 'Runyenjes'],
            ['county_id' => Countypp::where('name', 'Embu')->first()->id, 'name' => 'Mbeere South'],
            ['county_id' => Countypp::where('name', 'Embu')->first()->id, 'name' => 'Mbeere North'],

            // Kitui SubCounties
            ['county_id' => Countypp::where('name', 'Kitui')->first()->id, 'name' => 'Kitui West'],
            ['county_id' => Countypp::where('name', 'Kitui')->first()->id, 'name' => 'Kitui Central'],
            ['county_id' => Countypp::where('name', 'Kitui')->first()->id, 'name' => 'Kitui Rural'],
            ['county_id' => Countypp::where('name', 'Kitui')->first()->id, 'name' => 'Kitui South'],
            ['county_id' => Countypp::where('name', 'Kitui')->first()->id, 'name' => 'Kitui East'],
            ['county_id' => Countypp::where('name', 'Kitui')->first()->id, 'name' => 'Mwingi North'],
            ['county_id' => Countypp::where('name', 'Kitui')->first()->id, 'name' => 'Mwingi West'],
            ['county_id' => Countypp::where('name', 'Kitui')->first()->id, 'name' => 'Mwingi Central'],

            // Machakos SubCounties
            ['county_id' => Countypp::where('name', 'Machakos')->first()->id, 'name' => 'Machakos Town'],
            ['county_id' => Countypp::where('name', 'Machakos')->first()->id, 'name' => 'Mavoko'],
            ['county_id' => Countypp::where('name', 'Machakos')->first()->id, 'name' => 'Mwala'],
            ['county_id' => Countypp::where('name', 'Machakos')->first()->id, 'name' => 'Yatta'],
            ['county_id' => Countypp::where('name', 'Machakos')->first()->id, 'name' => 'Kangundo'],
            ['county_id' => Countypp::where('name', 'Machakos')->first()->id, 'name' => 'Matungulu'],
            ['county_id' => Countypp::where('name', 'Machakos')->first()->id, 'name' => 'Kathiani'],

            // Makueni SubCounties
            ['county_id' => Countypp::where('name', 'Makueni')->first()->id, 'name' => 'Makueni'],
            ['county_id' => Countypp::where('name', 'Makueni')->first()->id, 'name' => 'Kibwezi East'],
            ['county_id' => Countypp::where('name', 'Makueni')->first()->id, 'name' => 'Kibwezi West'],
            ['county_id' => Countypp::where('name', 'Makueni')->first()->id, 'name' => 'Mbooni'],
            ['county_id' => Countypp::where('name', 'Makueni')->first()->id, 'name' => 'Kilome'],
            ['county_id' => Countypp::where('name', 'Makueni')->first()->id, 'name' => 'Kaiti'],
            ['county_id' => Countypp::where('name', 'Makueni')->first()->id, 'name' => 'Nguu/Masumba'],

            // Nyandarua SubCounties
            ['county_id' => Countypp::where('name', 'Nyandarua')->first()->id, 'name' => 'Kinangop'],
            ['county_id' => Countypp::where('name', 'Nyandarua')->first()->id, 'name' => 'Kipipiri'],
            ['county_id' => Countypp::where('name', 'Nyandarua')->first()->id, 'name' => 'Ol Kalou'],
            ['county_id' => Countypp::where('name', 'Nyandarua')->first()->id, 'name' => 'Ol Jorok'],
            ['county_id' => Countypp::where('name', 'Nyandarua')->first()->id, 'name' => 'Ndaragwa'],

            // Nyeri SubCounties
            ['county_id' => Countypp::where('name', 'Nyeri')->first()->id, 'name' => 'Tetu'],
            ['county_id' => Countypp::where('name', 'Nyeri')->first()->id, 'name' => 'Kieni'],
            ['county_id' => Countypp::where('name', 'Nyeri')->first()->id, 'name' => 'Mathira'],
            ['county_id' => Countypp::where('name', 'Nyeri')->first()->id, 'name' => 'Othaya'],
            ['county_id' => Countypp::where('name', 'Nyeri')->first()->id, 'name' => 'Mukurweini'],
            ['county_id' => Countypp::where('name', 'Nyeri')->first()->id, 'name' => 'Nyeri Town'],

            // Kirinyaga SubCounties
            ['county_id' => Countypp::where('name', 'Kirinyaga')->first()->id, 'name' => 'Kirinyaga Central'],
            ['county_id' => Countypp::where('name', 'Kirinyaga')->first()->id, 'name' => 'Kirinyaga East'],
            ['county_id' => Countypp::where('name', 'Kirinyaga')->first()->id, 'name' => 'Kirinyaga West'],
            ['county_id' => Countypp::where('name', 'Kirinyaga')->first()->id, 'name' => 'Mwea'],
            ['county_id' => Countypp::where('name', 'Kirinyaga')->first()->id, 'name' => 'Gichugu'],

            // Murang'a SubCounties
            ['county_id' => Countypp::where('name', 'Murang\'a')->first()->id, 'name' => 'Kandara'],
            ['county_id' => Countypp::where('name', 'Murang\'a')->first()->id, 'name' => 'Gatanga'],
            ['county_id' => Countypp::where('name', 'Murang\'a')->first()->id, 'name' => 'Kigumo'],
            ['county_id' => Countypp::where('name', 'Murang\'a')->first()->id, 'name' => 'Kahuro'],
            ['county_id' => Countypp::where('name', 'Murang\'a')->first()->id, 'name' => 'Kangema'],
            ['county_id' => Countypp::where('name', 'Murang\'a')->first()->id, 'name' => 'Mathioya'],
            ['county_id' => Countypp::where('name', 'Murang\'a')->first()->id, 'name' => 'Maragua'],

            // Kiambu SubCounties
            ['county_id' => Countypp::where('name', 'Kiambu')->first()->id, 'name' => 'Gatundu South'],
            ['county_id' => Countypp::where('name', 'Kiambu')->first()->id, 'name' => 'Gatundu North'],
            ['county_id' => Countypp::where('name', 'Kiambu')->first()->id, 'name' => 'Juja'],
            ['county_id' => Countypp::where('name', 'Kiambu')->first()->id, 'name' => 'Thika Town'],
            ['county_id' => Countypp::where('name', 'Kiambu')->first()->id, 'name' => 'Ruiru'],
            ['county_id' => Countypp::where('name', 'Kiambu')->first()->id, 'name' => 'Githunguri'],
            ['county_id' => Countypp::where('name', 'Kiambu')->first()->id, 'name' => 'Kiambu'],
            ['county_id' => Countypp::where('name', 'Kiambu')->first()->id, 'name' => 'Kiambaa'],
            ['county_id' => Countypp::where('name', 'Kiambu')->first()->id, 'name' => 'Kabete'],
            ['county_id' => Countypp::where('name', 'Kiambu')->first()->id, 'name' => 'Kikuyu'],
            ['county_id' => Countypp::where('name', 'Kiambu')->first()->id, 'name' => 'Limuru'],
            ['county_id' => Countypp::where('name', 'Kiambu')->first()->id, 'name' => 'Lari'],

            // Turkana SubCounties
            ['county_id' => Countypp::where('name', 'Turkana')->first()->id, 'name' => 'Turkana Central'],
            ['county_id' => Countypp::where('name', 'Turkana')->first()->id, 'name' => 'Turkana East'],
            ['county_id' => Countypp::where('name', 'Turkana')->first()->id, 'name' => 'Turkana North'],
            ['county_id' => Countypp::where('name', 'Turkana')->first()->id, 'name' => 'Turkana South'],
            ['county_id' => Countypp::where('name', 'Turkana')->first()->id, 'name' => 'Loima'],
            ['county_id' => Countypp::where('name', 'Turkana')->first()->id, 'name' => 'Turkana West'],

            // West Pokot SubCounties
            ['county_id' => Countypp::where('name', 'West Pokot')->first()->id, 'name' => 'Kapenguria'],
            ['county_id' => Countypp::where('name', 'West Pokot')->first()->id, 'name' => 'Sigor'],
            ['county_id' => Countypp::where('name', 'West Pokot')->first()->id, 'name' => 'Kacheliba'],
            ['county_id' => Countypp::where('name', 'West Pokot')->first()->id, 'name' => 'Pokot South'],

            // Samburu SubCounties
            ['county_id' => Countypp::where('name', 'Samburu')->first()->id, 'name' => 'Samburu East'],
            ['county_id' => Countypp::where('name', 'Samburu')->first()->id, 'name' => 'Samburu North'],
            ['county_id' => Countypp::where('name', 'Samburu')->first()->id, 'name' => 'Samburu West'],

            // Trans Nzoia SubCounties
            ['county_id' => Countypp::where('name', 'Trans Nzoia')->first()->id, 'name' => 'Kiminini'],
            ['county_id' => Countypp::where('name', 'Trans Nzoia')->first()->id, 'name' => 'Saboti'],
            ['county_id' => Countypp::where('name', 'Trans Nzoia')->first()->id, 'name' => 'Cherangany'],
            ['county_id' => Countypp::where('name', 'Trans Nzoia')->first()->id, 'name' => 'Endebess'],
            ['county_id' => Countypp::where('name', 'Trans Nzoia')->first()->id, 'name' => 'Kwanza'],

            // Uasin Gishu SubCounties
            ['county_id' => Countypp::where('name', 'Uasin Gishu')->first()->id, 'name' => 'Ainabkoi'],
            ['county_id' => Countypp::where('name', 'Uasin Gishu')->first()->id, 'name' => 'Kapseret'],
            ['county_id' => Countypp::where('name', 'Uasin Gishu')->first()->id, 'name' => 'Kesses'],
            ['county_id' => Countypp::where('name', 'Uasin Gishu')->first()->id, 'name' => 'Moiben'],
            ['county_id' => Countypp::where('name', 'Uasin Gishu')->first()->id, 'name' => 'Soy'],
            ['county_id' => Countypp::where('name', 'Uasin Gishu')->first()->id, 'name' => 'Turbo'],

            // Elgeyo-Marakwet SubCounties
            ['county_id' => Countypp::where('name', 'Elgeyo-Marakwet')->first()->id, 'name' => 'Keiyo North'],
            ['county_id' => Countypp::where('name', 'Elgeyo-Marakwet')->first()->id, 'name' => 'Keiyo South'],
            ['county_id' => Countypp::where('name', 'Elgeyo-Marakwet')->first()->id, 'name' => 'Marakwet East'],
            ['county_id' => Countypp::where('name', 'Elgeyo-Marakwet')->first()->id, 'name' => 'Marakwet West'],

            // Nandi SubCounties
            ['county_id' => Countypp::where('name', 'Nandi')->first()->id, 'name' => 'Chesumei'],
            ['county_id' => Countypp::where('name', 'Nandi')->first()->id, 'name' => 'Emgwen'],
            ['county_id' => Countypp::where('name', 'Nandi')->first()->id, 'name' => 'Mosop'],
            ['county_id' => Countypp::where('name', 'Nandi')->first()->id, 'name' => 'Tinderet'],

            // Baringo SubCounties
            ['county_id' => Countypp::where('name', 'Baringo')->first()->id, 'name' => 'Baringo Central'],
            ['county_id' => Countypp::where('name', 'Baringo')->first()->id, 'name' => 'Baringo North'],
            ['county_id' => Countypp::where('name', 'Baringo')->first()->id, 'name' => 'Baringo South'],
            ['county_id' => Countypp::where('name', 'Baringo')->first()->id, 'name' => 'Eldama Ravine'],
            ['county_id' => Countypp::where('name', 'Baringo')->first()->id, 'name' => 'Mogotio'],
            ['county_id' => Countypp::where('name', 'Baringo')->first()->id, 'name' => 'Tiaty'],

            // Laikipia SubCounties
            ['county_id' => Countypp::where('name', 'Laikipia')->first()->id, 'name' => 'Laikipia Central'],
            ['county_id' => Countypp::where('name', 'Laikipia')->first()->id, 'name' => 'Laikipia East'],
            ['county_id' => Countypp::where('name', 'Laikipia')->first()->id, 'name' => 'Laikipia North'],
            ['county_id' => Countypp::where('name', 'Laikipia')->first()->id, 'name' => 'Laikipia West'],
            ['county_id' => Countypp::where('name', 'Laikipia')->first()->id, 'name' => 'Nyahururu'],

            // Nakuru SubCounties
            ['county_id' => Countypp::where('name', 'Nakuru')->first()->id, 'name' => 'Nakuru Town East'],
            ['county_id' => Countypp::where('name', 'Nakuru')->first()->id, 'name' => 'Nakuru Town West'],
            ['county_id' => Countypp::where('name', 'Nakuru')->first()->id, 'name' => 'Molo'],
            ['county_id' => Countypp::where('name', 'Nakuru')->first()->id, 'name' => 'Njoro'],
            ['county_id' => Countypp::where('name', 'Nakuru')->first()->id, 'name' => 'Naivasha'],
            ['county_id' => Countypp::where('name', 'Nakuru')->first()->id, 'name' => 'Gilgil'],
            ['county_id' => Countypp::where('name', 'Nakuru')->first()->id, 'name' => 'Kuresoi South'],
            ['county_id' => Countypp::where('name', 'Nakuru')->first()->id, 'name' => 'Kuresoi North'],
            ['county_id' => Countypp::where('name', 'Nakuru')->first()->id, 'name' => 'Subukia'],
            ['county_id' => Countypp::where('name', 'Nakuru')->first()->id, 'name' => 'Rongai'],
            ['county_id' => Countypp::where('name', 'Nakuru')->first()->id, 'name' => 'Bahati'],

            // Narok SubCounties
            ['county_id' => Countypp::where('name', 'Narok')->first()->id, 'name' => 'Narok North'],
            ['county_id' => Countypp::where('name', 'Narok')->first()->id, 'name' => 'Narok South'],
            ['county_id' => Countypp::where('name', 'Narok')->first()->id, 'name' => 'Narok East'],
            ['county_id' => Countypp::where('name', 'Narok')->first()->id, 'name' => 'Narok West'],
            ['county_id' => Countypp::where('name', 'Narok')->first()->id, 'name' => 'Transmara East'],
            ['county_id' => Countypp::where('name', 'Narok')->first()->id, 'name' => 'Transmara West'],

            // Kajiado SubCounties
            ['county_id' => Countypp::where('name', 'Kajiado')->first()->id, 'name' => 'Kajiado Central'],
            ['county_id' => Countypp::where('name', 'Kajiado')->first()->id, 'name' => 'Kajiado North'],
            ['county_id' => Countypp::where('name', 'Kajiado')->first()->id, 'name' => 'Kajiado South'],
            ['county_id' => Countypp::where('name', 'Kajiado')->first()->id, 'name' => 'Kajiado East'],
            ['county_id' => Countypp::where('name', 'Kajiado')->first()->id, 'name' => 'Kajiado West'],

            // Kericho SubCounties
            ['county_id' => Countypp::where('name', 'Kericho')->first()->id, 'name' => 'Ainamoi'],
            ['county_id' => Countypp::where('name', 'Kericho')->first()->id, 'name' => 'Belgut'],
            ['county_id' => Countypp::where('name', 'Kericho')->first()->id, 'name' => 'Bureti'],
            ['county_id' => Countypp::where('name', 'Kericho')->first()->id, 'name' => 'Kipkelion East'],
            ['county_id' => Countypp::where('name', 'Kericho')->first()->id, 'name' => 'Kipkelion West'],
            ['county_id' => Countypp::where('name', 'Kericho')->first()->id, 'name' => 'Sigowet/Soin'],

            // Bomet SubCounties
            ['county_id' => Countypp::where('name', 'Bomet')->first()->id, 'name' => 'Bomet Central'],
            ['county_id' => Countypp::where('name', 'Bomet')->first()->id, 'name' => 'Bomet East'],
            ['county_id' => Countypp::where('name', 'Bomet')->first()->id, 'name' => 'Chepalungu'],
            ['county_id' => Countypp::where('name', 'Bomet')->first()->id, 'name' => 'Konoin'],
            ['county_id' => Countypp::where('name', 'Bomet')->first()->id, 'name' => 'Sotik'],

            // Kakamega SubCounties
            ['county_id' => Countypp::where('name', 'Kakamega')->first()->id, 'name' => 'Butere'],
            ['county_id' => Countypp::where('name', 'Kakamega')->first()->id, 'name' => 'Kakamega Central'],
            ['county_id' => Countypp::where('name', 'Kakamega')->first()->id, 'name' => 'Kakamega East'],
            ['county_id' => Countypp::where('name', 'Kakamega')->first()->id, 'name' => 'Kakamega North'],
            ['county_id' => Countypp::where('name', 'Kakamega')->first()->id, 'name' => 'Kakamega South'],
            ['county_id' => Countypp::where('name', 'Kakamega')->first()->id, 'name' => 'Khwisero'],
            ['county_id' => Countypp::where('name', 'Kakamega')->first()->id, 'name' => 'Likuyani'],
            ['county_id' => Countypp::where('name', 'Kakamega')->first()->id, 'name' => 'Lugari'],
            ['county_id' => Countypp::where('name', 'Kakamega')->first()->id, 'name' => 'Matungu'],
            ['county_id' => Countypp::where('name', 'Kakamega')->first()->id, 'name' => 'Mumias East'],
            ['county_id' => Countypp::where('name', 'Kakamega')->first()->id, 'name' => 'Mumias West'],
            ['county_id' => Countypp::where('name', 'Kakamega')->first()->id, 'name' => 'Navakholo'],

            // Vihiga SubCounties
            ['county_id' => Countypp::where('name', 'Vihiga')->first()->id, 'name' => 'Emuhaya'],
            ['county_id' => Countypp::where('name', 'Vihiga')->first()->id, 'name' => 'Hamisi'],
            ['county_id' => Countypp::where('name', 'Vihiga')->first()->id, 'name' => 'Luanda'],
            ['county_id' => Countypp::where('name', 'Vihiga')->first()->id, 'name' => 'Sabatia'],
            ['county_id' => Countypp::where('name', 'Vihiga')->first()->id, 'name' => 'Vihiga'],

            // Bungoma SubCounties
            ['county_id' => Countypp::where('name', 'Bungoma')->first()->id, 'name' => 'Bungoma Central'],
            ['county_id' => Countypp::where('name', 'Bungoma')->first()->id, 'name' => 'Bungoma East'],
            ['county_id' => Countypp::where('name', 'Bungoma')->first()->id, 'name' => 'Bungoma North'],
            ['county_id' => Countypp::where('name', 'Bungoma')->first()->id, 'name' => 'Bungoma South'],
            ['county_id' => Countypp::where('name', 'Bungoma')->first()->id, 'name' => 'Bungoma West'],
            ['county_id' => Countypp::where('name', 'Bungoma')->first()->id, 'name' => 'Cheptais'],
            ['county_id' => Countypp::where('name', 'Bungoma')->first()->id, 'name' => 'Kimilili'],
            ['county_id' => Countypp::where('name', 'Bungoma')->first()->id, 'name' => 'Mt. Elgon'],
            ['county_id' => Countypp::where('name', 'Bungoma')->first()->id, 'name' => 'Sirisia'],
            ['county_id' => Countypp::where('name', 'Bungoma')->first()->id, 'name' => 'Tongaren'],
            ['county_id' => Countypp::where('name', 'Bungoma')->first()->id, 'name' => 'Webuye East'],
            ['county_id' => Countypp::where('name', 'Bungoma')->first()->id, 'name' => 'Webuye West'],

            // Busia SubCounties
            ['county_id' => Countypp::where('name', 'Busia')->first()->id, 'name' => 'Bunyala'],
            ['county_id' => Countypp::where('name', 'Busia')->first()->id, 'name' => 'Busia'],
            ['county_id' => Countypp::where('name', 'Busia')->first()->id, 'name' => 'Butula'],
            ['county_id' => Countypp::where('name', 'Busia')->first()->id, 'name' => 'Funyula'],
            ['county_id' => Countypp::where('name', 'Busia')->first()->id, 'name' => 'Nambale'],
            ['county_id' => Countypp::where('name', 'Busia')->first()->id, 'name' => 'Teso North'],
            ['county_id' => Countypp::where('name', 'Busia')->first()->id, 'name' => 'Teso South'],

            // Siaya SubCounties
            ['county_id' => Countypp::where('name', 'Siaya')->first()->id, 'name' => 'Alego Usonga'],
            ['county_id' => Countypp::where('name', 'Siaya')->first()->id, 'name' => 'Bondo'],
            ['county_id' => Countypp::where('name', 'Siaya')->first()->id, 'name' => 'Gem'],
            ['county_id' => Countypp::where('name', 'Siaya')->first()->id, 'name' => 'Rarieda'],
            ['county_id' => Countypp::where('name', 'Siaya')->first()->id, 'name' => 'Ugenya'],
            ['county_id' => Countypp::where('name', 'Siaya')->first()->id, 'name' => 'Ugunja'],

            // Kisumu SubCounties
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu East'],
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu West'],
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Kisumu Central'],
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Seme'],
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Nyando'],
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Muhoroni'],
            ['county_id' => Countypp::where('name', 'Kisumu')->first()->id, 'name' => 'Nyakach'],

            // Homa Bay SubCounties
            ['county_id' => Countypp::where('name', 'Homa Bay')->first()->id, 'name' => 'Homa Bay Town'],
            ['county_id' => Countypp::where('name', 'Homa Bay')->first()->id, 'name' => 'Kabondo Kasipul'],
            ['county_id' => Countypp::where('name', 'Homa Bay')->first()->id, 'name' => 'Karachuonyo'],
            ['county_id' => Countypp::where('name', 'Homa Bay')->first()->id, 'name' => 'Kasipul'],
            ['county_id' => Countypp::where('name', 'Homa Bay')->first()->id, 'name' => 'Mbita'],
            ['county_id' => Countypp::where('name', 'Homa Bay')->first()->id, 'name' => 'Ndhiwa'],
            ['county_id' => Countypp::where('name', 'Homa Bay')->first()->id, 'name' => 'Rangwe'],
            ['county_id' => Countypp::where('name', 'Homa Bay')->first()->id, 'name' => 'Suba'],

            // Migori SubCounties
            ['county_id' => Countypp::where('name', 'Migori')->first()->id, 'name' => 'Awendo'],
            ['county_id' => Countypp::where('name', 'Migori')->first()->id, 'name' => 'Kuria East'],
            ['county_id' => Countypp::where('name', 'Migori')->first()->id, 'name' => 'Kuria West'],
            ['county_id' => Countypp::where('name', 'Migori')->first()->id, 'name' => 'Nyatike'],
            ['county_id' => Countypp::where('name', 'Migori')->first()->id, 'name' => 'Rongo'],
            ['county_id' => Countypp::where('name', 'Migori')->first()->id, 'name' => 'Suna East'],
            ['county_id' => Countypp::where('name', 'Migori')->first()->id, 'name' => 'Suna West'],
            ['county_id' => Countypp::where('name', 'Migori')->first()->id, 'name' => 'Uriri'],

            // Kisii SubCounties
            ['county_id' => Countypp::where('name', 'Kisii')->first()->id, 'name' => 'Bobasi'],
            ['county_id' => Countypp::where('name', 'Kisii')->first()->id, 'name' => 'Bomachoge Borabu'],
            ['county_id' => Countypp::where('name', 'Kisii')->first()->id, 'name' => 'Bomachoge Chache'],
            ['county_id' => Countypp::where('name', 'Kisii')->first()->id, 'name' => 'Bonchari'],
            ['county_id' => Countypp::where('name', 'Kisii')->first()->id, 'name' => 'Kitutu Chache North'],
            ['county_id' => Countypp::where('name', 'Kisii')->first()->id, 'name' => 'Kitutu Chache South'],
            ['county_id' => Countypp::where('name', 'Kisii')->first()->id, 'name' => 'Nyaribari Chache'],
            ['county_id' => Countypp::where('name', 'Kisii')->first()->id, 'name' => 'Nyaribari Masaba'],
            ['county_id' => Countypp::where('name', 'Kisii')->first()->id, 'name' => 'South Mugirango'],

            // Nyamira SubCounties
            ['county_id' => Countypp::where('name', 'Nyamira')->first()->id, 'name' => 'Borabu'],
            ['county_id' => Countypp::where('name', 'Nyamira')->first()->id, 'name' => 'Manga'],
            ['county_id' => Countypp::where('name', 'Nyamira')->first()->id, 'name' => 'Masaba North'],
            ['county_id' => Countypp::where('name', 'Nyamira')->first()->id, 'name' => 'Nyamira North'],
            ['county_id' => Countypp::where('name', 'Nyamira')->first()->id, 'name' => 'Nyamira South'],
        ];

        SubCountypp::insert($subCountypps);
    }
}