<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prof_area_of_specialisation;

class ProfAreaOfSpecialisationSeeder extends Seeder
{
    public function run()
    {
        $specialisations = [
            // Agriculture & Agribusiness
            'Crop Production',
            'Animal Husbandry',
            'Agricultural Economics',
            'Agribusiness Management',

            // Animal Health Sciences
            'Veterinary Medicine',
            'Animal Nutrition',
            'Veterinary Surgery',

            // Architecture, Design, Planning and Land Management
            'Urban Planning',
            'Landscape Architecture',
            'Interior Design',

            // Arts
            'Fine Arts',
            'Music',
            'Theatre Arts',
            'Literature',

            // Business
            'Finance',
            'Marketing',
            'Human Resource Management',
            'Accounting',

            // Computing and Information Sciences
            'Software Development',
            'Cybersecurity',
            'Data Science',
            'Artificial Intelligence',

            // Education
            'Curriculum Development',
            'Educational Psychology',
            'Special Needs Education',

            // Engineering
            'Civil Engineering',
            'Mechanical Engineering',
            'Electrical Engineering',
            'Chemical Engineering',

            // Environmental Sciences & Natural Resource Management
            'Environmental Conservation',
            'Forestry',
            'Wildlife Management',

            // Food Science and Nutrition
            'Food Technology',
            'Nutrition and Dietetics',
            'Food Safety',

            // GeoScience
            'Geology',
            'Geophysics',
            'Geospatial Science',

            // Hospitality & Tourism
            'Hotel Management',
            'Tourism Management',
            'Culinary Arts',

            // Human Health Sciences
            'Nursing',
            'Public Health',
            'Pharmacy',
            'Radiography',

            // Humanities and Social Sciences
            'Sociology',
            'Psychology',
            'Anthropology',
            'Political Science',

            // Languages
            'Linguistics',
            'Translation',
            'Literary Studies',

            // Law
            'Corporate Law',
            'Criminal Law',
            'Human Rights Law',
            'Environmental Law',

            // Mathematics, Actuarial Science & Economics
            'Pure Mathematics',
            'Applied Mathematics',
            'Actuarial Science',
            'Economics',

            // Physical Education
            'Sports Science',
            'Physical Therapy',
            'Coaching',

            // Religious Studies
            'Theology',
            'Religious Education',
            'Philosophy of Religion',

            // Science
            'Biology',
            'Chemistry',
            'Physics',
            'Biotechnology',

            // Secondary Education Level
            'Mathematics Education',
            'Science Education',
            'Language Education',

            // Special Education
            'Inclusive Education',
            'Autism Spectrum Disorders',
            'Hearing Impairments',

            // Technical Training
            'Automotive Engineering',
            'Electrical Installation',
            'Welding and Fabrication',

            // Textile Technology, Clothing and Fashion Design
            'Fashion Design',
            'Textile Technology',
            'Garment Making',
        ];

        foreach ($specialisations as $specialisation) {
            Prof_area_of_specialisation::firstOrCreate(['name' => $specialisation]);
        }
    }
}
