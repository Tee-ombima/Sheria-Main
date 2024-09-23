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
        $counties = [
            'Mombasa' => [
                'Changamwe' => ['Changamwe', 'Port Reitz'],
                'Jomvu' => ['Jomvu', 'Mikindani'],
                'Kisauni' => ['Mwakirunge', 'Bamburi'],
                'Nyali' => ['Frere Town', 'Kongowea'],
                'Likoni' => ['Likoni', 'Shika Adabu'],
                'Mvita' => ['Mvita', 'Tudor'],
            ],
            'Kwale' => [
                'Msambweni' => ['Diani', 'Gombato'],
                'Lunga Lunga' => ['Vanga', 'Dzombo'],
                'Matuga' => ['Tiwi', 'Kinango'],
                'Kinango' => ['Mackinnon Road', 'Kasemeni'],
            ],
            'Kilifi' => [
                'Kilifi North' => ['Mnarani', 'Sokoni'],
                'Kilifi South' => ['Junju', 'Chasimba'],
                'Kaloleni' => ['Kaloleni', 'Mariakani'],
                'Rabai' => ['Rabai', 'Ruruma'],
                'Ganze' => ['Bamba', 'Ganze'],
                'Malindi' => ['Malindi Town', 'Ganda'],
                'Magarini' => ['Marafa', 'Magarini'],
            ],
            'Tana River' => [
                'Garsen' => ['Garsen South', 'Garsen West'],
                'Galole' => ['Tana Delta', 'Galole'],
                'Bura' => ['Bura', 'Chewele'],
            ],
            'Lamu' => [
                'Lamu East' => ['Faza', 'Kiunga'],
                'Lamu West' => ['Mpeketoni', 'Hindi'],
            ],
            'Taita Taveta' => [
                'Taveta' => ['Taveta', 'Mwatate'],
                'Wundanyi' => ['Wundanyi', 'Mbale'],
                'Mwatate' => ['Mwatate', 'Mwachabo'],
                'Voi' => ['Voi', 'Sagala'],
            ],
            'Garissa' => [
                'Garissa Township' => ['Galbet', 'Waberi'],
                'Balambala' => ['Balambala', 'Danyere'],
                'Lagdera' => ['Benane', 'Modogashe'],
                'Dadaab' => ['Dadaab', 'Liboi'],
                'Fafi' => ['Fafi', 'Bura'],
                'Ijara' => ['Ijara', 'Hulugho'],
            ],
            'Wajir' => [
                'Wajir North' => ['Bute', 'Korondille'],
                'Wajir East' => ['Wagberi', 'Township'],
                'Tarbaj' => ['Elben', 'Kutulo'],
                'Wajir West' => ['Habaswein', 'Griftu'],
                'Eldas' => ['Eldas', 'Malkagufu'],
                'Wajir South' => ['Benane', 'Diif'],
            ],
            'Mandera' => [
                'Mandera West' => ['Takaba', 'Banissa'],
                'Banissa' => ['Banissa', 'Bulla Jamhuri'],
                'Mandera North' => ['Rhamu', 'Ashabito'],
                'Mandera South' => ['Elwak', 'Shimbir Fatuma'],
                'Mandera East' => ['Arabia', 'Neboi'],
                'Lafey' => ['Lafey', 'Sala'],
            ],
            'Marsabit' => [
                'Moyale' => ['Butiye', 'Uran'],
                'North Horr' => ['Kalacha', 'Loiyangalani'],
                'Saku' => ['Karare', 'Sagante'],
                'Laisamis' => ['Laisamis', 'Korr'],
            ],
            'Isiolo' => [
                'Isiolo North' => ['Bulapesa', 'Burat'],
                'Isiolo South' => ['Garbatulla', 'Sericho'],
            ],
            'Meru' => [
                'Igembe South' => ['Igembe South', 'Kangeta'],
                'Igembe Central' => ['Igembe Central', 'Njia'],
                'Igembe North' => ['Igembe North', 'Antubetwe Kiongo'],
                'Tigania West' => ['Tigania West', 'Mikinduri'],
                'Tigania East' => ['Tigania East', 'Muthara'],
                'North Imenti' => ['North Imenti', 'Mwiteria'],
                'Buuri' => ['Buuri', 'Timau'],
                'Central Imenti' => ['Central Imenti', 'Ntima West'],
                'South Imenti' => ['South Imenti', 'Nkubu'],
            ],
            'Tharaka-Nithi' => [
                'Maara' => ['Maara', 'Mwimbi'],
                'Chuka/Igambang\'ombe' => ['Igambang\'ombe', 'Karingani'],
                'Tharaka' => ['Tharaka South', 'Tharaka North'],
            ],
            'Embu' => [
                'Manyatta' => ['Manyatta', 'Kithimu'],
                'Runyenjes' => ['Runyenjes', 'Kagaari'],
                'Mbeere South' => ['Mbeere South', 'Mavuria'],
                'Mbeere North' => ['Mbeere North', 'Evurore'],
            ],
            'Kitui' => [
                'Mwingi North' => ['Ngomeni', 'Kyuso'],
                'Mwingi West' => ['Migwani', 'Nguni'],
                'Mwingi Central' => ['Mwingi Central', 'Nguni'],
                'Kitui West' => ['Mutonguni', 'Matinyani'],
                'Kitui Rural' => ['Kisasi', 'Mbitini'],
                'Kitui Central' => ['Kitui Central', 'Kisasi'],
                'Kitui East' => ['Mutito', 'Zombe'],
                'Kitui South' => ['Mutomo', 'Ikutha'],
            ],
            'Machakos' => [
                'Masinga' => ['Masinga', 'Ekalakala'],
                'Yatta' => ['Yatta', 'Katangi'],
                'Kangundo' => ['Kangundo', 'Matungulu'],
                'Matungulu' => ['Matungulu', 'Kangundo'],
                'Kathiani' => ['Kathiani', 'Mitaboni'],
                'Mavoko' => ['Mlolongo', 'Athi River'],
                'Machakos Town' => ['Machakos Town', 'Mumbuni North'],
                'Mwala' => ['Mwala', 'Masii'],
            ],
            'Makueni' => [
                'Mbooni' => ['Mbooni', 'Kathonzweni'],
                'Kilome' => ['Kilome', 'Mukaa'],
                'Kaiti' => ['Kaiti', 'Ukia'],
                'Makueni' => ['Makueni', 'Kathonzweni'],
                'Kibwezi West' => ['Kibwezi West', 'Makindu'],
                'Kibwezi East' => ['Kibwezi East', 'Mtito Andei'],
            ],
            'Nyandarua' => [
                'Kinangop' => ['Kinangop', 'Magumu'],
                'Kipipiri' => ['Kipipiri', 'Githioro'],
                'Ol Kalou' => ['Ol Kalou', 'Gathanji'],
                'Ol Jorok' => ['Ol Jorok', 'Nyairoko'],
                'Ndaragwa' => ['Ndaragwa', 'Shamata'],
            ],
            'Nyeri' => [
                'Tetu' => ['Tetu', 'Kirimukuyu'],
                'Kieni' => ['Kieni West', 'Kieni East'],
                'Mathira' => ['Mathira East', 'Mathira West'],
                'Othaya' => ['Othaya', 'Chinga'],
                'Mukurweini' => ['Mukurweini', 'Gikondi'],
                'Nyeri Town' => ['Rware', 'Kamakwa'],
            ],
            'Kirinyaga' => [
                'Mwea' => ['Mwea East', 'Mwea West'],
                'Gichugu' => ['Gichugu', 'Kabare'],
                'Ndia' => ['Ndia', 'Kariti'],
                'Kirinyaga Central' => ['Kirinyaga Central', 'Kerugoya'],
            ],
            'Murang\'a' => [
                'Kangema' => ['Kangema', 'Mugoiri'],
                'Mathioya' => ['Mathioya', 'Kamacharia'],
                'Kiharu' => ['Kiharu', 'Wangu'],
                'Kigumo' => ['Kigumo', 'Muthithi'],
                'Maragwa' => ['Maragwa', 'Kambiti'],
                'Kandara' => ['Kandara', 'Gaichanjiru'],
                'Gatanga' => ['Gatanga', 'Kariara'],
            ],
            'Kiambu' => [
                'Gatundu South' => ['Kiamwangi', 'Kiganjo'],
                'Gatundu North' => ['Gatundu North', 'Chania'],
                'Juja' => ['Juja', 'Murera'],
                'Thika Town' => ['Thika Town', 'Kamenu'],
                'Ruiru' => ['Ruiru', 'Gitothua'],
                'Githunguri' => ['Githunguri', 'Ikinu'],
                'Kiambu' => ['Kiambu', 'Ndumberi'],
                'Kiambaa' => ['Kiambaa', 'Karuri'],
                'Kabete' => ['Kabete', 'Uthiru'],
                'Kikuyu' => ['Kikuyu', 'Zambezi'],
                'Limuru' => ['Limuru', 'Ting\'ang\'a'],
                'Lari' => ['Lari', 'Kijabe'],
            ],
            'Turkana' => [
                'Turkana North' => ['Kaeris', 'Lopur'],
                'Turkana West' => ['Kakuma', 'Lopiding'],
                'Turkana Central' => ['Lodwar', 'Kanamkemer'],
                'Loima' => ['Loima', 'Turkwel'],
                'Turkana South' => ['Lokichar', 'Katilu'],
                'Turkana East' => ['Lokori', 'Kapedo'],
            ],
            'West Pokot' => [
                'Kapenguria' => ['Kapenguria', 'Siyoi'],
                'Sigor' => ['Sigor', 'Lomut'],
                'Kacheliba' => ['Kacheliba', 'Alale'],
                'Pokot South' => ['Pokot South', 'Chepareria'],
            ],
            'Samburu' => [
                'Samburu West' => ['Lorroki', 'Baragoi'],
                'Samburu North' => ['Samburu North', 'Nyiro'],
                'Samburu East' => ['Samburu East', 'Wamba'],
            ],
            'Trans Nzoia' => [
                'Kwanza' => ['Kwanza', 'Bidii'],
                'Endebess' => ['Endebess', 'Chepchoina'],
                'Saboti' => ['Saboti', 'Matisi'],
                'Kiminini' => ['Kiminini', 'Waitaluk'],
                'Cherangany' => ['Cherangany', 'Sirikwa'],
            ],
            'Uasin Gishu' => [
                'Soy' => ['Soy', 'Ziwa'],
                'Turbo' => ['Turbo', 'Tapsagoi'],
                'Moiben' => ['Moiben', 'Sergoit'],
                'Ainabkoi' => ['Ainabkoi', 'Kapseret'],
                'Kapseret' => ['Kapseret', 'Langas'],
                'Kesses' => ['Kesses', 'Cheptiret'],
            ],
            'Elgeyo-Marakwet' => [
                'Marakwet East' => ['Chebiemit', 'Embobut'],
                'Marakwet West' => ['Kapsowar', 'Chesongoch'],
                'Keiyo North' => ['Keiyo North', 'Iten'],
                'Keiyo South' => ['Keiyo South', 'Kaptarakwa'],
            ],
            'Nandi' => [
                'Tinderet' => ['Tinderet', 'Songhor'],
                'Aldai' => ['Aldai', 'Kabiyet'],
                'Nandi Hills' => ['Nandi Hills', 'Kilibwoni'],
                'Chesumei' => ['Chesumei', 'Kapsabet'],
                'Emgwen' => ['Emgwen', 'Chepkumia'],
                'Mosop' => ['Mosop', 'Kapngetuny'],
            ],
            'Baringo' => [
                'Tiaty' => ['Tiaty East', 'Tiaty West'],
                'Baringo North' => ['Baringo North', 'Saimo Kipsaraman'],
                'Baringo Central' => ['Kabarnet', 'Sacho'],
                'Baringo South' => ['Baringo South', 'Marigat'],
                'Mogotio' => ['Mogotio', 'Maji Mazuri'],
                'Eldama Ravine' => ['Eldama Ravine', 'Koibatek'],
            ],
            'Laikipia' => [
                'Laikipia West' => ['Ol Moran', 'Rumuruti'],
                'Laikipia East' => ['Nanyuki', 'Ngobit'],
                'Laikipia North' => ['Dol Dol', 'Mukogodo'],
            ],
            'Nakuru' => [
                'Molo' => ['Molo', 'Elburgon'],
                'Njoro' => ['Njoro', 'Mauche'],
                'Naivasha' => ['Naivasha', 'Hell\'s Gate'],
                'Gilgil' => ['Gilgil', 'Eburru'],
                'Kuresoi South' => ['Kuresoi South', 'Amalo'],
                'Kuresoi North' => ['Kuresoi North', 'Sirikwa'],
                'Subukia' => ['Subukia', 'Kabazi'],
                'Rongai' => ['Rongai', 'Solai'],
                'Bahati' => ['Bahati', 'Dundori'],
                'Nakuru Town West' => ['Nakuru Town West', 'Shabab'],
                'Nakuru Town East' => ['Nakuru Town East', 'Naka'],
            ],
            'Narok' => [
                'Kilgoris' => ['Kilgoris', 'Shankoe'],
                'Emurua Dikirr' => ['Emurua Dikirr', 'Ilkerin'],
                'Narok North' => ['Narok North', 'Olerai'],
                'Narok East' => ['Narok East', 'Ilmashariani'],
                'Narok South' => ['Narok South', 'Ololulung\'a'],
                'Narok West' => ['Narok West', 'Olooltoto'],
            ],
            'Kajiado' => [
                'Kajiado North' => ['Kiserian', 'Ngong'],
                'Kajiado Central' => ['Kajiado Central', 'Matapato'],
                'Kajiado East' => ['Kajiado East', 'Isinya'],
                'Kajiado West' => ['Kajiado West', 'Ewaso Kedong'],
                'Kajiado South' => ['Kajiado South', 'Loitokitok'],
            ],
            'Kericho' => [
                'Kipkelion East' => ['Kipkelion East', 'Lumbwa'],
                'Kipkelion West' => ['Kipkelion West', 'Chilchila'],
                'Ainamoi' => ['Ainamoi', 'Kapsoit'],
                'Bureti' => ['Bureti', 'Litein'],
                'Belgut' => ['Belgut', 'Kapsuser'],
                'Soin/Sigowet' => ['Soin', 'Sigowet'],
            ],
            'Bomet' => [
                'Sotik' => ['Sotik', 'Kaplong'],
                'Chepalungu' => ['Chepalungu', 'Sigor'],
                'Bomet East' => ['Bomet East', 'Silibwet'],
                'Bomet Central' => ['Bomet Central', 'Longisa'],
                'Konoin' => ['Konoin', 'Mogogosiek'],
            ],
            'Kakamega' => [
                'Lugari' => ['Lugari', 'Lumakanda'],
                'Likuyani' => ['Likuyani', 'Kongoni'],
                'Malava' => ['Malava', 'West Kabras'],
                'Lurambi' => ['Lurambi', 'Shieywe'],
                'Navakholo' => ['Navakholo', 'Shinoyi'],
                'Mumias West' => ['Mumias West', 'Matungu'],
                'Mumias East' => ['Mumias East', 'Lusheya'],
                'Matungu' => ['Matungu', 'Khalaba'],
                'Butere' => ['Butere', 'Marama'],
                'Khwisero' => ['Khwisero', 'Mundeku'],
                'Shinyalu' => ['Shinyalu', 'Muranda'],
                'Ikolomani' => ['Ikolomani', 'Idakho Central'],
            ],
            'Vihiga' => [
                'Vihiga' => ['Vihiga', 'Lugaga'],
                'Sabatia' => ['Sabatia', 'Chavakali'],
                'Hamisi' => ['Hamisi', 'Shamakhokho'],
                'Luanda' => ['Luanda', 'Mwibona'],
                'Emuhaya' => ['Emuhaya', 'North East Bunyore'],
            ],
            'Bungoma' => [
                'Mt Elgon' => ['Mt Elgon', 'Kapsokwony'],
                'Sirisia' => ['Sirisia', 'Malakisi'],
                'Kabuchai' => ['Kabuchai', 'West Nalondo'],
                'Bumula' => ['Bumula', 'Kimaeti'],
                'Kanduyi' => ['Kanduyi', 'Matisi'],
                'Webuye East' => ['Webuye East', 'Misikhu'],
                'Webuye West' => ['Webuye West', 'Bokoli'],
                'Kimilili' => ['Kimilili', 'Kibingei'],
                'Tongaren' => ['Tongaren', 'Mbakalo'],
            ],
            'Busia' => [
                'Teso North' => ['Malaba', 'Ang\'urai'],
                'Teso South' => ['Amukura', 'Chakol'],
                'Nambale' => ['Nambale', 'Buyofu'],
                'Matayos' => ['Matayos', 'Burumba'],
                'Butula' => ['Butula', 'Kingandole'],
                'Funyula' => ['Funyula', 'Ageng\'a'],
                'Budalangi' => ['Budalangi', 'Bunyala'],
            ],
            'Siaya' => [
                'Ugenya' => ['Ugenya', 'North Ugenya'],
                'Ugunja' => ['Ugunja', 'Sigomere'],
                'Alego Usonga' => ['Alego Usonga', 'South Alego'],
                'Gem' => ['Gem', 'Yala'],
                'Bondo' => ['Bondo', 'Maranda'],
                'Rarieda' => ['Rarieda', 'West Asembo'],
            ],
            'Kisumu' => [
                'Kisumu East' => ['Kisumu East', 'Kolwa East'],
                'Kisumu West' => ['Kisumu West', 'North West Kisumu'],
                'Kisumu Central' => ['Kisumu Central', 'Nyalenda'],
                'Seme' => ['Seme', 'Central Seme'],
                'Nyando' => ['Nyando', 'East Kano Wawidhi'],
                'Muhoroni' => ['Muhoroni', 'Chemelil'],
                'Nyakach' => ['Nyakach', 'Pap Onditi'],
            ],
            'Homa Bay' => [
                'Kasipul' => ['Kasipul', 'West Kasipul'],
                'Kabondo Kasipul' => ['Kabondo Kasipul', 'East Kabondo'],
                'Karachuonyo' => ['Karachuonyo', 'North Karachuonyo'],
                'Rangwe' => ['Rangwe', 'East Rangwe'],
                'Homa Bay Town' => ['Homa Bay Town', 'Asego'],
                'Ndhiwa' => ['Ndhiwa', 'Kanyamwa'],
                'Mbita' => ['Mbita', 'Rusinga'],
                'Suba' => ['Suba', 'Gwassi'],
            ],
            'Migori' => [
                'Rongo' => ['Rongo', 'South Kamagambo'],
                'Awendo' => ['Awendo', 'North Sakwa'],
                'Suna East' => ['Suna East', 'Suna Central'],
                'Suna West' => ['Suna West', 'Wasweta'],
                'Uriri' => ['Uriri', 'Central Kanyamkago'],
                'Nyatike' => ['Nyatike', 'Macalder'],
                'Kuria West' => ['Kuria West', 'Ikerege'],
                'Kuria East' => ['Kuria East', 'Ntimaru'],
            ],
            'Kisii' => [
                'Bonchari' => ['Bonchari', 'Bogiakumu'],
                'South Mugirango' => ['South Mugirango', 'Tabaka'],
                'Bomachoge Borabu' => ['Bomachoge Borabu', 'Kenyenya'],
                'Bobasi' => ['Bobasi', 'Masige East'],
                'Bomachoge Chache' => ['Bomachoge Chache', 'Riana'],
                'Nyaribari Masaba' => ['Nyaribari Masaba', 'Kegati'],
                'Nyaribari Chache' => ['Nyaribari Chache', 'Nyamasibi'],
                'Kitutu Chache North' => ['Kitutu Chache North', 'Monyerero'],
                'Kitutu Chache South' => ['Kitutu Chache South', 'Nyakoe'],
            ],
            'Nyamira' => [
                'West Mugirango' => ['West Mugirango', 'Itibo'],
                'North Mugirango' => ['North Mugirango', 'Ekerenyo'],
                'Borabu' => ['Borabu', 'Mekenene'],
                'Kitutu Masaba' => ['Kitutu Masaba', 'Gachuba'],
            ],
            'Nairobi' => [
                'Westlands' => ['Westlands', 'Kangemi'],
                'Dagoretti North' => ['Dagoretti North', 'Kilimani'],
                'Dagoretti South' => ['Dagoretti South', 'Mutuini'],
                'Lang\'ata' => ['Lang\'ata', 'South C'],
                'Kibra' => ['Kibra', 'Lindi'],
                'Roysambu' => ['Roysambu', 'Kahawa West'],
                'Kasarani' => ['Kasarani', 'Clay City'],
                'Ruaraka' => ['Ruaraka', 'Utalii'],
                'Embakasi South' => ['Embakasi South', 'Imara Daima'],
                'Embakasi North' => ['Embakasi North', 'Kariobangi North'],
                'Embakasi Central' => ['Embakasi Central', 'Kayole'],
                'Embakasi East' => ['Embakasi East', 'Umoja'],
                'Embakasi West' => ['Embakasi West', 'Mukuru'],
                'Makadara' => ['Makadara', 'Viwandani'],
                'Kamukunji' => ['Kamukunji', 'Shauri Moyo'],
                'Starehe' => ['Starehe', 'Pumwani'],
                'Mathare' => ['Mathare', 'Mabatini'],
            ],
        ];

        foreach ($counties as $homecountyName => $constituencies) {
            $homecounty = Homecounty::firstWhere('name', $homecountyName);

            if ($homecounty) {
                foreach ($constituencies as $constituencyName => $subcounties) {
                    $constituency = Constituency::firstWhere([
                        'name' => $constituencyName,
                        'homecounty_id' => $homecounty->id,
                    ]);

                    if ($constituency) {
                        // Ensure $subcounties is an array
                        if (!is_array($subcounties)) {
                            $subcounties = [$subcounties];
                        }

                        foreach ($subcounties as $subcountyName) {
                            Subcounty::firstOrCreate([
                                'name' => $subcountyName,
                                'homecounty_id' => $homecounty->id,
                                'constituency_id' => $constituency->id,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
