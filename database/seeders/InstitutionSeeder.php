<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Institution;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institutions = [
            'University of Nairobi',
            'Kenyatta University',
            'Moi University',
            'Jomo Kenyatta University of Agriculture and Technology',
            'Egerton University',
            'Maseno University',
            'Technical University of Kenya',
            'Technical University of Mombasa',
            'Dedan Kimathi University of Technology',
            'Masinde Muliro University of Science and Technology',
            'Murang\'a University of Technology',
            'Meru University of Science and Technology',
            'Kisii University',
            'Chuka University',
            'Laikipia University',
            'Karatina University',
            'South Eastern Kenya University',
            'University of Eldoret',
            'Pwani University',
            'Rongo University',
            'Machakos University',
            'Kirinyaga University',
            'Maasai Mara University',
            'Kabarak University',
            'Strathmore University',
            'United States International University Africa',
            'Catholic University of Eastern Africa',
            'Daystar University',
            'Africa Nazarene University',
            'KCA University',
            'Mount Kenya University',
            'Zetech University',
            'Kenya Methodist University',
            'Pan Africa Christian University',
            'St. Paul\'s University',
            'Scott Christian University',
            'Great Lakes University of Kisumu',
            'Presbyterian University of East Africa',
            'Adventist University of Africa',
            'Amref International University',
            'Management University of Africa',
            'Riara University',
            'UMMA University',
            'Gretsa University',
            'Kibabii University',
            'Garissa University',
            'Taita Taveta University',
            'Tharaka University',
            'Cooperative University of Kenya',
            'Tom Mboya University College',
            'Alupe University College',
            'Kaimosi Friends University College',
            'Kisumu National Polytechnic',
            'Kenya Coast National Polytechnic',
            'Nyeri National Polytechnic',
            'Eldoret National Polytechnic',
            'The Kenya Polytechnic University College',
            'Kenya Medical Training College',
            'Kenya Institute of Mass Communication',
            'Kenya School of Law',
            'Kenya School of Government',
            'Kenya School of Monetary Studies',
            'Kenya School of Aviation',
            'Kenya Utalii College',
            'Kenya Institute of Special Education',
            'Kenya Institute of Curriculum Development',
            'Kenya Institute of Management',
            'Kenya Institute of Public Policy Research and Analysis',
            'Kenya Institute of Social Work and Community Development',
            'Kenya Institute of Business and Counselling Studies',
            'Kenya Institute of Professional Studies',
            'Kenya Institute of Highways and Building Technology',
            'Kenya Institute of Development Studies',
            'Kenya Institute of Biomedical Sciences and Technology',
            'Kenya Institute of Security and Criminal Justice',
            'Kenya Institute of Surveying and Mapping',
            'Kenya Institute of Energy Research and Development',
            'Kenya Institute of Marine Technology',
            'Kenya Institute of Education',
        ];

        foreach ($institutions as $institution) {
            Institution::create(['name' => $institution]);
        }
    }
}