<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Constituency;
use App\Models\Subcounty;

class ConstituencySeeder extends Seeder
{
    public function run()
    {
        $constituencies = [
            // Nairobi Subcounties
            ['name' => 'Westlands Constituency', 'subcounty_id' => Subcounty::where('name', 'Westlands')->first()->id],
            ['name' => 'Dagoretti North Constituency', 'subcounty_id' => Subcounty::where('name', 'Dagoretti')->first()->id],
            ['name' => 'Dagoretti South Constituency', 'subcounty_id' => Subcounty::where('name', 'Dagoretti')->first()->id],
            ['name' => 'Langata Constituency', 'subcounty_id' => Subcounty::where('name', 'Langata')->first()->id],
            ['name' => 'Kibra Constituency', 'subcounty_id' => Subcounty::where('name', 'Kibra')->first()->id],
            ['name' => 'Roysambu Constituency', 'subcounty_id' => Subcounty::where('name', 'Roysambu')->first()->id],
            ['name' => 'Kasarani Constituency', 'subcounty_id' => Subcounty::where('name', 'Kasarani')->first()->id],
            ['name' => 'Ruaraka Constituency', 'subcounty_id' => Subcounty::where('name', 'Ruaraka')->first()->id],
            ['name' => 'Embakasi South Constituency', 'subcounty_id' => Subcounty::where('name', 'Embakasi South')->first()->id],
            ['name' => 'Embakasi North Constituency', 'subcounty_id' => Subcounty::where('name', 'Embakasi North')->first()->id],
            ['name' => 'Embakasi Central Constituency', 'subcounty_id' => Subcounty::where('name', 'Embakasi Central')->first()->id],
            ['name' => 'Embakasi East Constituency', 'subcounty_id' => Subcounty::where('name', 'Embakasi East')->first()->id],
            ['name' => 'Embakasi West Constituency', 'subcounty_id' => Subcounty::where('name', 'Embakasi West')->first()->id],
            ['name' => 'Makadara Constituency', 'subcounty_id' => Subcounty::where('name', 'Makadara')->first()->id],
            ['name' => 'Kamukunji Constituency', 'subcounty_id' => Subcounty::where('name', 'Kamukunji')->first()->id],
            ['name' => 'Starehe Constituency', 'subcounty_id' => Subcounty::where('name', 'Starehe')->first()->id],
            ['name' => 'Mathare Constituency', 'subcounty_id' => Subcounty::where('name', 'Mathare')->first()->id],

            // Mombasa Subcounties
            ['name' => 'Changamwe Constituency', 'subcounty_id' => Subcounty::where('name', 'Changamwe')->first()->id],
            ['name' => 'Jomvu Constituency', 'subcounty_id' => Subcounty::where('name', 'Jomvu')->first()->id],
            ['name' => 'Kisauni Constituency', 'subcounty_id' => Subcounty::where('name', 'Kisauni')->first()->id],
            ['name' => 'Nyali Constituency', 'subcounty_id' => Subcounty::where('name', 'Nyali')->first()->id],
            ['name' => 'Likoni Constituency', 'subcounty_id' => Subcounty::where('name', 'Likoni')->first()->id],
            ['name' => 'Mvita Constituency', 'subcounty_id' => Subcounty::where('name', 'Mvita')->first()->id],

            // Kisumu Subcounties
            ['name' => 'Kisumu East Constituency', 'subcounty_id' => Subcounty::where('name', 'Kisumu East')->first()->id],
            ['name' => 'Kisumu West Constituency', 'subcounty_id' => Subcounty::where('name', 'Kisumu West')->first()->id],
            ['name' => 'Kisumu Central Constituency', 'subcounty_id' => Subcounty::where('name', 'Kisumu Central')->first()->id],
            ['name' => 'Seme Constituency', 'subcounty_id' => Subcounty::where('name', 'Seme')->first()->id],
            ['name' => 'Nyando Constituency', 'subcounty_id' => Subcounty::where('name', 'Nyando')->first()->id],
            ['name' => 'Muhoroni Constituency', 'subcounty_id' => Subcounty::where('name', 'Muhoroni')->first()->id],
            ['name' => 'Nyakach Constituency', 'subcounty_id' => Subcounty::where('name', 'Nyakach')->first()->id],

            // Kwale Subcounties
            ['name' => 'Matuga Constituency', 'subcounty_id' => Subcounty::where('name', 'Matuga')->first()->id],
            ['name' => 'Msambweni Constituency', 'subcounty_id' => Subcounty::where('name', 'Msambweni')->first()->id],
            ['name' => 'Lunga Lunga Constituency', 'subcounty_id' => Subcounty::where('name', 'Lunga Lunga')->first()->id],
            ['name' => 'Kinango Constituency', 'subcounty_id' => Subcounty::where('name', 'Kinango')->first()->id],

            // Kilifi Subcounties
            ['name' => 'Kilifi South Constituency', 'subcounty_id' => Subcounty::where('name', 'Kilifi South')->first()->id],
            ['name' => 'Kilifi North Constituency', 'subcounty_id' => Subcounty::where('name', 'Kilifi North')->first()->id],
            ['name' => 'Kaloleni Constituency', 'subcounty_id' => Subcounty::where('name', 'Kaloleni')->first()->id],
            ['name' => 'Rabai Constituency', 'subcounty_id' => Subcounty::where('name', 'Rabai')->first()->id],
            ['name' => 'Ganze Constituency', 'subcounty_id' => Subcounty::where('name', 'Ganze')->first()->id],
            ['name' => 'Malindi Constituency', 'subcounty_id' => Subcounty::where('name', 'Malindi')->first()->id],
            ['name' => 'Magarini Constituency', 'subcounty_id' => Subcounty::where('name', 'Magarini')->first()->id],

            // Tana River Subcounties
            ['name' => 'Garsen Constituency', 'subcounty_id' => Subcounty::where('name', 'Garsen')->first()->id],
            ['name' => 'Galole Constituency', 'subcounty_id' => Subcounty::where('name', 'Galole')->first()->id],
            ['name' => 'Bura Constituency', 'subcounty_id' => Subcounty::where('name', 'Bura')->first()->id],

            // Lamu Subcounties
            ['name' => 'Lamu East Constituency', 'subcounty_id' => Subcounty::where('name', 'Lamu East')->first()->id],
            ['name' => 'Lamu West Constituency', 'subcounty_id' => Subcounty::where('name', 'Lamu West')->first()->id],

            // Taita-Taveta Subcounties
            ['name' => 'Taveta Constituency', 'subcounty_id' => Subcounty::where('name', 'Taveta')->first()->id],
            ['name' => 'Wundanyi Constituency', 'subcounty_id' => Subcounty::where('name', 'Wundanyi')->first()->id],
            ['name' => 'Mwatate Constituency', 'subcounty_id' => Subcounty::where('name', 'Mwatate')->first()->id],
            ['name' => 'Voi Constituency', 'subcounty_id' => Subcounty::where('name', 'Voi')->first()->id],

            // Garissa Subcounties
            ['name' => 'Garissa Township Constituency', 'subcounty_id' => Subcounty::where('name', 'Garissa Township')->first()->id],
            ['name' => 'Balambala Constituency', 'subcounty_id' => Subcounty::where('name', 'Balambala')->first()->id],
            ['name' => 'Lagdera Constituency', 'subcounty_id' => Subcounty::where('name', 'Lagdera')->first()->id],
            ['name' => 'Dadaab Constituency', 'subcounty_id' => Subcounty::where('name', 'Dadaab')->first()->id],
            ['name' => 'Fafi Constituency', 'subcounty_id' => Subcounty::where('name', 'Fafi')->first()->id],
            ['name' => 'Ijara Constituency', 'subcounty_id' => Subcounty::where('name', 'Ijara')->first()->id],

            // Wajir Subcounties
            ['name' => 'Wajir North Constituency', 'subcounty_id' => Subcounty::where('name', 'Wajir North')->first()->id],
            ['name' => 'Wajir East Constituency', 'subcounty_id' => Subcounty::where('name', 'Wajir East')->first()->id],
            ['name' => 'Wajir South Constituency', 'subcounty_id' => Subcounty::where('name', 'Wajir South')->first()->id],
            ['name' => 'Wajir West Constituency', 'subcounty_id' => Subcounty::where('name', 'Wajir West')->first()->id],
            ['name' => 'Tarbaj Constituency', 'subcounty_id' => Subcounty::where('name', 'Tarbaj')->first()->id],
            ['name' => 'Eldas Constituency', 'subcounty_id' => Subcounty::where('name', 'Eldas')->first()->id],

            // Mandera Subcounties
            ['name' => 'Mandera North Constituency', 'subcounty_id' => Subcounty::where('name', 'Mandera North')->first()->id],
            ['name' => 'Mandera West Constituency', 'subcounty_id' => Subcounty::where('name', 'Mandera West')->first()->id],
            ['name' => 'Mandera East Constituency', 'subcounty_id' => Subcounty::where('name', 'Mandera East')->first()->id],
            ['name' => 'Mandera South Constituency', 'subcounty_id' => Subcounty::where('name', 'Mandera South')->first()->id],
            ['name' => 'Banissa Constituency', 'subcounty_id' => Subcounty::where('name', 'Banissa')->first()->id],
            ['name' => 'Lafey Constituency', 'subcounty_id' => Subcounty::where('name', 'Lafey')->first()->id],

            // Marsabit Subcounties
            ['name' => 'Moyale Constituency', 'subcounty_id' => Subcounty::where('name', 'Moyale')->first()->id],
            ['name' => 'North Horr Constituency', 'subcounty_id' => Subcounty::where('name', 'North Horr')->first()->id],
            ['name' => 'Saku Constituency', 'subcounty_id' => Subcounty::where('name', 'Saku')->first()->id],
            ['name' => 'Laisamis Constituency', 'subcounty_id' => Subcounty::where('name', 'Laisamis')->first()->id],

            // Isiolo Subcounties
            ['name' => 'Isiolo North Constituency', 'subcounty_id' => Subcounty::where('name', 'Isiolo North')->first()->id],
            ['name' => 'Isiolo South Constituency', 'subcounty_id' => Subcounty::where('name', 'Isiolo South')->first()->id],

            // Meru Subcounties
            ['name' => 'Imenti North Constituency', 'subcounty_id' => Subcounty::where('name', 'Imenti North')->first()->id],
            ['name' => 'Imenti South Constituency', 'subcounty_id' => Subcounty::where('name', 'Imenti South')->first()->id],
            ['name' => 'Igembe South Constituency', 'subcounty_id' => Subcounty::where('name', 'Igembe South')->first()->id],
            ['name' => 'Igembe Central Constituency', 'subcounty_id' => Subcounty::where('name', 'Igembe Central')->first()->id],
            ['name' => 'Igembe North Constituency', 'subcounty_id' => Subcounty::where('name', 'Igembe North')->first()->id],
            ['name' => 'Tigania West Constituency', 'subcounty_id' => Subcounty::where('name', 'Tigania West')->first()->id],
            ['name' => 'Tigania East Constituency', 'subcounty_id' => Subcounty::where('name', 'Tigania East')->first()->id],
            ['name' => 'Buuri Constituency', 'subcounty_id' => Subcounty::where('name', 'Buuri')->first()->id],

            // Tharaka-Nithi Subcounties
            ['name' => 'Tharaka South Constituency', 'subcounty_id' => Subcounty::where('name', 'Tharaka South')->first()->id],
            ['name' => 'Tharaka North Constituency', 'subcounty_id' => Subcounty::where('name', 'Tharaka North')->first()->id],
            ['name' => 'Chuka/Igambang\'ombe Constituency', 'subcounty_id' => Subcounty::where('name', 'Chuka/Igambang\'ombe')->first()->id],
            ['name' => 'Maara Constituency', 'subcounty_id' => Subcounty::where('name', 'Maara')->first()->id],

            // Embu Subcounties
            ['name' => 'Manyatta Constituency', 'subcounty_id' => Subcounty::where('name', 'Manyatta')->first()->id],
            ['name' => 'Runyenjes Constituency', 'subcounty_id' => Subcounty::where('name', 'Runyenjes')->first()->id],
            ['name' => 'Mbeere South Constituency', 'subcounty_id' => Subcounty::where('name', 'Mbeere South')->first()->id],
            ['name' => 'Mbeere North Constituency', 'subcounty_id' => Subcounty::where('name', 'Mbeere North')->first()->id],

            // Kitui Subcounties
            ['name' => 'Kitui West Constituency', 'subcounty_id' => Subcounty::where('name', 'Kitui West')->first()->id],
            ['name' => 'Kitui Central Constituency', 'subcounty_id' => Subcounty::where('name', 'Kitui Central')->first()->id],
            ['name' => 'Kitui Rural Constituency', 'subcounty_id' => Subcounty::where('name', 'Kitui Rural')->first()->id],
            ['name' => 'Kitui South Constituency', 'subcounty_id' => Subcounty::where('name', 'Kitui South')->first()->id],
            ['name' => 'Kitui East Constituency', 'subcounty_id' => Subcounty::where('name', 'Kitui East')->first()->id],
            ['name' => 'Mwingi North Constituency', 'subcounty_id' => Subcounty::where('name', 'Mwingi North')->first()->id],
            ['name' => 'Mwingi West Constituency', 'subcounty_id' => Subcounty::where('name', 'Mwingi West')->first()->id],
            ['name' => 'Mwingi Central Constituency', 'subcounty_id' => Subcounty::where('name', 'Mwingi Central')->first()->id],

                        // Machakos Subcounties (continued)
                        ['name' => 'Kathiani Constituency', 'subcounty_id' => Subcounty::where('name', 'Kathiani')->first()->id],

                        // Makueni Subcounties
                        ['name' => 'Makueni Constituency', 'subcounty_id' => Subcounty::where('name', 'Makueni')->first()->id],
                        ['name' => 'Kibwezi East Constituency', 'subcounty_id' => Subcounty::where('name', 'Kibwezi East')->first()->id],
                        ['name' => 'Kibwezi West Constituency', 'subcounty_id' => Subcounty::where('name', 'Kibwezi West')->first()->id],
                        ['name' => 'Mbooni Constituency', 'subcounty_id' => Subcounty::where('name', 'Mbooni')->first()->id],
                        ['name' => 'Kilome Constituency', 'subcounty_id' => Subcounty::where('name', 'Kilome')->first()->id],
                        ['name' => 'Kaiti Constituency', 'subcounty_id' => Subcounty::where('name', 'Kaiti')->first()->id],
                        ['name' => 'Nguu/Masumba Constituency', 'subcounty_id' => Subcounty::where('name', 'Nguu/Masumba')->first()->id],
            
                        // Nyandarua Subcounties
                        ['name' => 'Kinangop Constituency', 'subcounty_id' => Subcounty::where('name', 'Kinangop')->first()->id],
                        ['name' => 'Kipipiri Constituency', 'subcounty_id' => Subcounty::where('name', 'Kipipiri')->first()->id],
                        ['name' => 'Ol Kalou Constituency', 'subcounty_id' => Subcounty::where('name', 'Ol Kalou')->first()->id],
                        ['name' => 'Ol Jorok Constituency', 'subcounty_id' => Subcounty::where('name', 'Ol Jorok')->first()->id],
                        ['name' => 'Ndaragwa Constituency', 'subcounty_id' => Subcounty::where('name', 'Ndaragwa')->first()->id],
            
                        // Nyeri Subcounties
                        ['name' => 'Tetu Constituency', 'subcounty_id' => Subcounty::where('name', 'Tetu')->first()->id],
                        ['name' => 'Kieni Constituency', 'subcounty_id' => Subcounty::where('name', 'Kieni')->first()->id],
                        ['name' => 'Mathira Constituency', 'subcounty_id' => Subcounty::where('name', 'Mathira')->first()->id],
                        ['name' => 'Othaya Constituency', 'subcounty_id' => Subcounty::where('name', 'Othaya')->first()->id],
                        ['name' => 'Mukurweini Constituency', 'subcounty_id' => Subcounty::where('name', 'Mukurweini')->first()->id],
                        ['name' => 'Nyeri Town Constituency', 'subcounty_id' => Subcounty::where('name', 'Nyeri Town')->first()->id],
            
                        // Kirinyaga Subcounties
                        ['name' => 'Kirinyaga Central Constituency', 'subcounty_id' => Subcounty::where('name', 'Kirinyaga Central')->first()->id],
                        ['name' => 'Kirinyaga East Constituency', 'subcounty_id' => Subcounty::where('name', 'Kirinyaga East')->first()->id],
                        ['name' => 'Kirinyaga West Constituency', 'subcounty_id' => Subcounty::where('name', 'Kirinyaga West')->first()->id],
                        ['name' => 'Mwea Constituency', 'subcounty_id' => Subcounty::where('name', 'Mwea')->first()->id],
                        ['name' => 'Gichugu Constituency', 'subcounty_id' => Subcounty::where('name', 'Gichugu')->first()->id],
            
                        // Murang'a Subcounties
                        ['name' => 'Kandara Constituency', 'subcounty_id' => Subcounty::where('name', 'Kandara')->first()->id],
                        ['name' => 'Gatanga Constituency', 'subcounty_id' => Subcounty::where('name', 'Gatanga')->first()->id],
                        ['name' => 'Kigumo Constituency', 'subcounty_id' => Subcounty::where('name', 'Kigumo')->first()->id],
                        ['name' => 'Kahuro Constituency', 'subcounty_id' => Subcounty::where('name', 'Kahuro')->first()->id],
                        ['name' => 'Kangema Constituency', 'subcounty_id' => Subcounty::where('name', 'Kangema')->first()->id],
                        ['name' => 'Mathioya Constituency', 'subcounty_id' => Subcounty::where('name', 'Mathioya')->first()->id],
                        ['name' => 'Maragua Constituency', 'subcounty_id' => Subcounty::where('name', 'Maragua')->first()->id],
            
                        // Kiambu Subcounties
                        ['name' => 'Gatundu South Constituency', 'subcounty_id' => Subcounty::where('name', 'Gatundu South')->first()->id],
                        ['name' => 'Gatundu North Constituency', 'subcounty_id' => Subcounty::where('name', 'Gatundu North')->first()->id],
                        ['name' => 'Juja Constituency', 'subcounty_id' => Subcounty::where('name', 'Juja')->first()->id],
                        ['name' => 'Thika Town Constituency', 'subcounty_id' => Subcounty::where('name', 'Thika Town')->first()->id],
                        ['name' => 'Ruiru Constituency', 'subcounty_id' => Subcounty::where('name', 'Ruiru')->first()->id],
                        ['name' => 'Githunguri Constituency', 'subcounty_id' => Subcounty::where('name', 'Githunguri')->first()->id],
                        ['name' => 'Kiambu Constituency', 'subcounty_id' => Subcounty::where('name', 'Kiambu')->first()->id],
                        ['name' => 'Kiambaa Constituency', 'subcounty_id' => Subcounty::where('name', 'Kiambaa')->first()->id],
                        ['name' => 'Kabete Constituency', 'subcounty_id' => Subcounty::where('name', 'Kabete')->first()->id],
                        ['name' => 'Kikuyu Constituency', 'subcounty_id' => Subcounty::where('name', 'Kikuyu')->first()->id],
                        ['name' => 'Limuru Constituency', 'subcounty_id' => Subcounty::where('name', 'Limuru')->first()->id],
                        ['name' => 'Lari Constituency', 'subcounty_id' => Subcounty::where('name', 'Lari')->first()->id],
            
                        // Turkana Subcounties
                        ['name' => 'Turkana Central Constituency', 'subcounty_id' => Subcounty::where('name', 'Turkana Central')->first()->id],
                        ['name' => 'Turkana East Constituency', 'subcounty_id' => Subcounty::where('name', 'Turkana East')->first()->id],
                        ['name' => 'Turkana North Constituency', 'subcounty_id' => Subcounty::where('name', 'Turkana North')->first()->id],
                        ['name' => 'Turkana South Constituency', 'subcounty_id' => Subcounty::where('name', 'Turkana South')->first()->id],
                        ['name' => 'Loima Constituency', 'subcounty_id' => Subcounty::where('name', 'Loima')->first()->id],
                        ['name' => 'Turkana West Constituency', 'subcounty_id' => Subcounty::where('name', 'Turkana West')->first()->id],
            
                        // West Pokot Subcounties
                        ['name' => 'Kapenguria Constituency', 'subcounty_id' => Subcounty::where('name', 'Kapenguria')->first()->id],
                        ['name' => 'Sigor Constituency', 'subcounty_id' => Subcounty::where('name', 'Sigor')->first()->id],
                        ['name' => 'Kacheliba Constituency', 'subcounty_id' => Subcounty::where('name', 'Kacheliba')->first()->id],
                        ['name' => 'Pokot South Constituency', 'subcounty_id' => Subcounty::where('name', 'Pokot South')->first()->id],
            
                        // Samburu Subcounties
                        ['name' => 'Samburu East Constituency', 'subcounty_id' => Subcounty::where('name', 'Samburu East')->first()->id],
                        ['name' => 'Samburu North Constituency', 'subcounty_id' => Subcounty::where('name', 'Samburu North')->first()->id],
                        ['name' => 'Samburu West Constituency', 'subcounty_id' => Subcounty::where('name', 'Samburu West')->first()->id],
            
                        // Trans Nzoia Subcounties
                        ['name' => 'Kiminini Constituency', 'subcounty_id' => Subcounty::where('name', 'Kiminini')->first()->id],
                        ['name' => 'Saboti Constituency', 'subcounty_id' => Subcounty::where('name', 'Saboti')->first()->id],
                        ['name' => 'Cherangany Constituency', 'subcounty_id' => Subcounty::where('name', 'Cherangany')->first()->id],
                        ['name' => 'Endebess Constituency', 'subcounty_id' => Subcounty::where('name', 'Endebess')->first()->id],
                        ['name' => 'Kwanza Constituency', 'subcounty_id' => Subcounty::where('name', 'Kwanza')->first()->id],
            
                        // Uasin Gishu Subcounties
                        ['name' => 'Ainabkoi Constituency', 'subcounty_id' => Subcounty::where('name', 'Ainabkoi')->first()->id],
                        ['name' => 'Kapseret Constituency', 'subcounty_id' => Subcounty::where('name', 'Kapseret')->first()->id],
                        ['name' => 'Kesses Constituency', 'subcounty_id' => Subcounty::where('name', 'Kesses')->first()->id],
                        ['name' => 'Moiben Constituency', 'subcounty_id' => Subcounty::where('name', 'Moiben')->first()->id],
                        ['name' => 'Soy Constituency', 'subcounty_id' => Subcounty::where('name', 'Soy')->first()->id],
                        ['name' => 'Turbo Constituency', 'subcounty_id' => Subcounty::where('name', 'Turbo')->first()->id],
            
                        // Elgeyo-Marakwet Subcounties
                        ['name' => 'Keiyo North Constituency', 'subcounty_id' => Subcounty::where('name', 'Keiyo North')->first()->id],
                        ['name' => 'Keiyo South Constituency', 'subcounty_id' => Subcounty::where('name', 'Keiyo South')->first()->id],
                        ['name' => 'Marakwet East Constituency', 'subcounty_id' => Subcounty::where('name', 'Marakwet East')->first()->id],
                        ['name' => 'Marakwet West Constituency', 'subcounty_id' => Subcounty::where('name', 'Marakwet West')->first()->id],
            
                        // Nandi Subcounties
                        ['name' => 'Chesumei Constituency', 'subcounty_id' => Subcounty::where('name', 'Chesumei')->first()->id],
                        ['name' => 'Emgwen Constituency', 'subcounty_id' => Subcounty::where('name', 'Emgwen')->first()->id],
                        ['name' => 'Mosop Constituency', 'subcounty_id' => Subcounty::where('name', 'Mosop')->first()->id],
                        ['name' => 'Tinderet Constituency', 'subcounty_id' => Subcounty::where('name', 'Tinderet')->first()->id],
            
                        // Baringo Subcounties
                        ['name' => 'Baringo Central Constituency', 'subcounty_id' => Subcounty::where('name', 'Baringo Central')->first()->id],
                        ['name' => 'Baringo North Constituency', 'subcounty_id' => Subcounty::where('name', 'Baringo North')->first()->id],
                        ['name' => 'Baringo South Constituency', 'subcounty_id' => Subcounty::where('name', 'Baringo South')->first()->id],
                        ['name' => 'Eldama Ravine Constituency', 'subcounty_id' => Subcounty::where('name', 'Eldama Ravine')->first()->id],
                        ['name' => 'Mogotio Constituency', 'subcounty_id' => Subcounty::where('name', 'Mogotio')->first()->id],
                        ['name' => 'Tiaty Constituency', 'subcounty_id' => Subcounty::where('name', 'Tiaty')->first()->id],
            
                        // Laikipia Subcounties
                        ['name' => 'Laikipia Central Constituency', 'subcounty_id' => Subcounty::where('name', 'Laikipia Central')->first()->id],
                        ['name' => 'Laikipia East Constituency', 'subcounty_id' => Subcounty::where('name', 'Laikipia East')->first()->id],
                        ['name' => 'Laikipia North Constituency', 'subcounty_id' => Subcounty::where('name', 'Laikipia North')->first()->id],
                        ['name' => 'Laikipia West Constituency', 'subcounty_id' => Subcounty::where('name', 'Laikipia West')->first()->id],
                        ['name' => 'Nyahururu Constituency', 'subcounty_id' => Subcounty::where('name', 'Nyahururu')->first()->id],
            
                        // Nakuru Subcounties
                        ['name' => 'Nakuru Town East Constituency', 'subcounty_id' => Subcounty::where('name', 'Nakuru Town East')->first()->id],
                        ['name' => 'Nakuru Town West Constituency', 'subcounty_id' => Subcounty::where('name', 'Nakuru Town West')->first()->id],
                        ['name' => 'Molo Constituency', 'subcounty_id' => Subcounty::where('name', 'Molo')->first()->id],
                        ['name' => 'Njoro Constituency', 'subcounty_id' => Subcounty::where('name', 'Njoro')->first()->id],
                        ['name' => 'Naivasha Constituency', 'subcounty_id' => Subcounty::where('name', 'Naivasha')->first()->id],
                        ['name' => 'Gilgil Constituency', 'subcounty_id' => Subcounty::where('name', 'Gilgil')->first()->id],
                        ['name' => 'Kuresoi South Constituency', 'subcounty_id' => Subcounty::where('name', 'Kuresoi South')->first()->id],
                        ['name' => 'Kuresoi North Constituency', 'subcounty_id' => Subcounty::where('name', 'Kuresoi North')->first()->id],
                        ['name' => 'Subukia Constituency', 'subcounty_id' => Subcounty::where('name', 'Subukia')->first()->id],
                        ['name' => 'Rongai Constituency', 'subcounty_id' => Subcounty::where('name', 'Rongai')->first()->id],
                        ['name' => 'Bahati Constituency', 'subcounty_id' => Subcounty::where('name', 'Bahati')->first()->id],
            
                        // Narok Subcounties
                        ['name' => 'Narok North Constituency', 'subcounty_id' => Subcounty::where('name', 'Narok North')->first()->id],
                        ['name' => 'Narok South Constituency', 'subcounty_id' => Subcounty::where('name', 'Narok South')->first()->id],
                        ['name' => 'Narok East Constituency', 'subcounty_id' => Subcounty::where('name', 'Narok East')->first()->id],
                        ['name' => 'Narok West Constituency', 'subcounty_id' => Subcounty::where('name', 'Narok West')->first()->id],
                        ['name' => 'Transmara East Constituency', 'subcounty_id' => Subcounty::where('name', 'Transmara East')->first()->id],
                        ['name' => 'Transmara West Constituency', 'subcounty_id' => Subcounty::where('name', 'Transmara West')->first()->id],
            
                        // Kajiado Subcounties
                        ['name' => 'Kajiado Central Constituency', 'subcounty_id' => Subcounty::where('name', 'Kajiado Central')->first()->id],
                        ['name' => 'Kajiado North Constituency', 'subcounty_id' => Subcounty::where('name', 'Kajiado North')->first()->id],
                        ['name' => 'Kajiado South Constituency', 'subcounty_id' => Subcounty::where('name', 'Kajiado South')->first()->id],
                        ['name' => 'Kajiado East Constituency', 'subcounty_id' => Subcounty::where('name', 'Kajiado East')->first()->id],
                        ['name' => 'Kajiado West Constituency', 'subcounty_id' => Subcounty::where('name', 'Kajiado West')->first()->id],
            
                        // Kericho Subcounties
                        ['name' => 'Ainamoi Constituency', 'subcounty_id' => Subcounty::where('name', 'Ainamoi')->first()->id],
                        ['name' => 'Belgut Constituency', 'subcounty_id' => Subcounty::where('name', 'Belgut')->first()->id],
                        ['name' => 'Bureti Constituency', 'subcounty_id' => Subcounty::where('name', 'Bureti')->first()->id],
                        ['name' => 'Kipkelion East Constituency', 'subcounty_id' => Subcounty::where('name', 'Kipkelion East')->first()->id],
                        ['name' => 'Kipkelion West Constituency', 'subcounty_id' => Subcounty::where('name', 'Kipkelion West')->first()->id],
                        ['name' => 'Sigowet/Soin Constituency', 'subcounty_id' => Subcounty::where('name', 'Sigowet/Soin')->first()->id],
            
                        // Bomet Subcounties
                        ['name' => 'Bomet Central Constituency', 'subcounty_id' => Subcounty::where('name', 'Bomet Central')->first()->id],
                        ['name' => 'Bomet East Constituency', 'subcounty_id' => Subcounty::where('name', 'Bomet East')->first()->id],
                        ['name' => 'Chepalungu Constituency', 'subcounty_id' => Subcounty::where('name', 'Chepalungu')->first()->id],
                        ['name' => 'Konoin Constituency', 'subcounty_id' => Subcounty::where('name', 'Konoin')->first()->id],
                        ['name' => 'Sotik Constituency', 'subcounty_id' => Subcounty::where('name', 'Sotik')->first()->id],
            
                        // Kakamega Subcounties
                        ['name' => 'Butere Constituency', 'subcounty_id' => Subcounty::where('name', 'Butere')->first()->id],
                        ['name' => 'Kakamega Central Constituency', 'subcounty_id' => Subcounty::where('name', 'Kakamega Central')->first()->id],
                        ['name' => 'Kakamega East Constituency', 'subcounty_id' => Subcounty::where('name', 'Kakamega East')->first()->id],
                        ['name' => 'Kakamega North Constituency', 'subcounty_id' => Subcounty::where('name', 'Kakamega North')->first()->id],
                        ['name' => 'Kakamega South Constituency', 'subcounty_id' => Subcounty::where('name', 'Kakamega South')->first()->id],
                        ['name' => 'Khwisero Constituency', 'subcounty_id' => Subcounty::where('name', 'Khwisero')->first()->id],
                        ['name' => 'Likuyani Constituency', 'subcounty_id' => Subcounty::where('name', 'Likuyani')->first()->id],
                        ['name' => 'Lugari Constituency', 'subcounty_id' => Subcounty::where('name', 'Lugari')->first()->id],
                        ['name' => 'Matungu Constituency', 'subcounty_id' => Subcounty::where('name', 'Matungu')->first()->id],
                        ['name' => 'Mumias East Constituency', 'subcounty_id' => Subcounty::where('name', 'Mumias East')->first()->id],
                        ['name' => 'Mumias West Constituency', 'subcounty_id' => Subcounty::where('name', 'Mumias West')->first()->id],
                        ['name' => 'Navakholo Constituency', 'subcounty_id' => Subcounty::where('name', 'Navakholo')->first()->id],
            
                        // Vihiga Subcounties
                        ['name' => 'Emuhaya Constituency', 'subcounty_id' => Subcounty::where('name', 'Emuhaya')->first()->id],
                        ['name' => 'Hamisi Constituency', 'subcounty_id' => Subcounty::where('name', 'Hamisi')->first()->id],
                        ['name' => 'Luanda Constituency', 'subcounty_id' => Subcounty::where('name', 'Luanda')->first()->id],
                        ['name' => 'Sabatia Constituency', 'subcounty_id' => Subcounty::where('name', 'Sabatia')->first()->id],
                        ['name' => 'Vihiga Constituency', 'subcounty_id' => Subcounty::where('name', 'Vihiga')->first()->id],
            
                        // Bungoma Subcounties
                        ['name' => 'Bungoma Central Constituency', 'subcounty_id' => Subcounty::where('name', 'Bungoma Central')->first()->id],
                        ['name' => 'Bungoma East Constituency', 'subcounty_id' => Subcounty::where('name', 'Bungoma East')->first()->id],
                        ['name' => 'Bungoma North Constituency', 'subcounty_id' => Subcounty::where('name', 'Bungoma North')->first()->id],
                        ['name' => 'Bungoma South Constituency', 'subcounty_id' => Subcounty::where('name', 'Bungoma South')->first()->id],
                        ['name' => 'Bungoma West Constituency', 'subcounty_id' => Subcounty::where('name', 'Bungoma West')->first()->id],
                        ['name' => 'Cheptais Constituency', 'subcounty_id' => Subcounty::where('name', 'Cheptais')->first()->id],
                        ['name' => 'Kimilili Constituency', 'subcounty_id' => Subcounty::where('name', 'Kimilili')->first()->id],
                        ['name' => 'Mt. Elgon Constituency', 'subcounty_id' => Subcounty::where('name', 'Mt. Elgon')->first()->id],
                        ['name' => 'Sirisia Constituency', 'subcounty_id' => Subcounty::where('name', 'Sirisia')->first()->id],
                        ['name' => 'Tongaren Constituency', 'subcounty_id' => Subcounty::where('name', 'Tongaren')->first()->id],
                        ['name' => 'Webuye East Constituency', 'subcounty_id' => Subcounty::where('name', 'Webuye East')->first()->id],
                        ['name' => 'Webuye West Constituency', 'subcounty_id' => Subcounty::where('name', 'Webuye West')->first()->id],
            
                        // Busia Subcounties
                        ['name' => 'Bunyala Constituency', 'subcounty_id' => Subcounty::where('name', 'Bunyala')->first()->id],
                        ['name' => 'Busia Constituency', 'subcounty_id' => Subcounty::where('name', 'Busia')->first()->id],
                        ['name' => 'Butula Constituency', 'subcounty_id' => Subcounty::where('name', 'Butula')->first()->id],
                        ['name' => 'Funyula Constituency', 'subcounty_id' => Subcounty::where('name', 'Funyula')->first()->id],
                        ['name' => 'Nambale Constituency', 'subcounty_id' => Subcounty::where('name', 'Nambale')->first()->id],
                        ['name' => 'Teso North Constituency', 'subcounty_id' => Subcounty::where('name', 'Teso North')->first()->id],
                        ['name' => 'Teso South Constituency', 'subcounty_id' => Subcounty::where('name', 'Teso South')->first()->id],
            
                        // Siaya Subcounties
                        ['name' => 'Alego Usonga Constituency', 'subcounty_id' => Subcounty::where('name', 'Alego Usonga')->first()->id],
                        ['name' => 'Bondo Constituency', 'subcounty_id' => Subcounty::where('name', 'Bondo')->first()->id],
                        ['name' => 'Gem Constituency', 'subcounty_id' => Subcounty::where('name', 'Gem')->first()->id],
                        ['name' => 'Rarieda Constituency', 'subcounty_id' => Subcounty::where('name', 'Rarieda')->first()->id],
                        ['name' => 'Ugenya Constituency', 'subcounty_id' => Subcounty::where('name', 'Ugenya')->first()->id],
                        ['name' => 'Ugunja Constituency', 'subcounty_id' => Subcounty::where('name', 'Ugunja')->first()->id],
            
                        
            
                        // Homa Bay Subcounties
                        ['name' => 'Homa Bay Town Constituency', 'subcounty_id' => Subcounty::where('name', 'Homa Bay Town')->first()->id],
                        ['name' => 'Kabondo Kasipul Constituency', 'subcounty_id' => Subcounty::where('name', 'Kabondo Kasipul')->first()->id],
                        ['name' => 'Karachuonyo Constituency', 'subcounty_id' => Subcounty::where('name', 'Karachuonyo')->first()->id],
                        ['name' => 'Kasipul Constituency', 'subcounty_id' => Subcounty::where('name', 'Kasipul')->first()->id],
                        ['name' => 'Mbita Constituency', 'subcounty_id' => Subcounty::where('name', 'Mbita')->first()->id],
                        ['name' => 'Ndhiwa Constituency', 'subcounty_id' => Subcounty::where('name', 'Ndhiwa')->first()->id],
                        ['name' => 'Rangwe Constituency', 'subcounty_id' => Subcounty::where('name', 'Rangwe')->first()->id],
                        ['name' => 'Suba Constituency', 'subcounty_id' => Subcounty::where('name', 'Suba')->first()->id],
            
                        // Migori Subcounties
                        ['name' => 'Awendo Constituency', 'subcounty_id' => Subcounty::where('name', 'Awendo')->first()->id],
                        ['name' => 'Kuria East Constituency', 'subcounty_id' => Subcounty::where('name', 'Kuria East')->first()->id],
                        ['name' => 'Kuria West Constituency', 'subcounty_id' => Subcounty::where('name', 'Kuria West')->first()->id],
                        ['name' => 'Nyatike Constituency', 'subcounty_id' => Subcounty::where('name', 'Nyatike')->first()->id],
                        ['name' => 'Rongo Constituency', 'subcounty_id' => Subcounty::where('name', 'Rongo')->first()->id],
                        ['name' => 'Suna East Constituency', 'subcounty_id' => Subcounty::where('name', 'Suna East')->first()->id],
                        ['name' => 'Suna West Constituency', 'subcounty_id' => Subcounty::where('name', 'Suna West')->first()->id],
                        ['name' => 'Uriri Constituency', 'subcounty_id' => Subcounty::where('name', 'Uriri')->first()->id],
            
                        // Kisii Subcounties
                        ['name' => 'Bobasi Constituency', 'subcounty_id' => Subcounty::where('name', 'Bobasi')->first()->id],
                        ['name' => 'Bomachoge Borabu Constituency', 'subcounty_id' => Subcounty::where('name', 'Bomachoge Borabu')->first()->id],
                        ['name' => 'Bomachoge Chache Constituency', 'subcounty_id' => Subcounty::where('name', 'Bomachoge Chache')->first()->id],
                        ['name' => 'Bonchari Constituency', 'subcounty_id' => Subcounty::where('name', 'Bonchari')->first()->id],
                        ['name' => 'Kitutu Chache North Constituency', 'subcounty_id' => Subcounty::where('name', 'Kitutu Chache North')->first()->id],
                        ['name' => 'Kitutu Chache South Constituency', 'subcounty_id' => Subcounty::where('name', 'Kitutu Chache South')->first()->id],
                        ['name' => 'Nyaribari Chache Constituency', 'subcounty_id' => Subcounty::where('name', 'Nyaribari Chache')->first()->id],
                        ['name' => 'Nyaribari Masaba Constituency', 'subcounty_id' => Subcounty::where('name', 'Nyaribari Masaba')->first()->id],
                        ['name' => 'South Mugirango Constituency', 'subcounty_id' => Subcounty::where('name', 'South Mugirango')->first()->id],
            
                        // Nyamira Subcounties
                        ['name' => 'Borabu Constituency', 'subcounty_id' => Subcounty::where('name', 'Borabu')->first()->id],
                        ['name' => 'Manga Constituency', 'subcounty_id' => Subcounty::where('name', 'Manga')->first()->id],
                        ['name' => 'Masaba North Constituency', 'subcounty_id' => Subcounty::where('name', 'Masaba North')->first()->id],
                        ['name' => 'Nyamira North Constituency', 'subcounty_id' => Subcounty::where('name', 'Nyamira North')->first()->id],
                        ['name' => 'Nyamira South Constituency', 'subcounty_id' => Subcounty::where('name', 'Nyamira South')->first()->id],
                    ];
            
                    Constituency::insert($constituencies);
                }
            }