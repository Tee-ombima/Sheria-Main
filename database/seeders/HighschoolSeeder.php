<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Highschool;

class HighschoolSeeder extends Seeder
{
    public function run()
    {
        $highschools = [
            'Agriculture & Agribusiness',
            'Animal Health Sciences',
            'Architecture, Design, Planning and Land Management',
            'Arts',
            'Business',
            'Computing and Information Sciences',
            'Education',
            'Engineering',
            'Environmental Sciences & Natural Resource Management',
            'Food Science and Nutrition',
            'GeoScience',
            'Hospitality & Tourism',
            'Human Health Sciences',
            'Humanities and Social Sciences',
            'Languages',
            'Law',
            'Mathematics, Actuarial Science & Economics',
            'Physical Education',
            'Religious Studies',
            'Science',
            'Secondary Education Level',
            'Special Education',
            'Technical Training',
            'Textile Technology, Clothing and Fashion Design',
        ];

        foreach ($highschools as $highschool) {
            Highschool::firstOrCreate(['name' => $highschool]);
        }
    }
}
