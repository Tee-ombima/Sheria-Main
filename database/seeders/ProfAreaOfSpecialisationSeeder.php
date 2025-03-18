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
            'Soil Science',
            'Agricultural Engineering',
            'Horticulture',
            'Agricultural Extension',
            'Agroforestry',
            'Food Security',

            // Animal Health Sciences
            'Veterinary Medicine',
            'Animal Nutrition',
            'Veterinary Surgery',
            'Veterinary Pathology',
            'Animal Breeding',
            'Veterinary Public Health',
            'Wildlife Medicine',
            'Veterinary Microbiology',
            'Animal Welfare',
            'Veterinary Parasitology',

            // Architecture, Design, Planning and Land Management
            'Urban Planning',
            'Landscape Architecture',
            'Interior Design',
            'Architectural Design',
            'Urban Design',
            'Land Surveying',
            'Geomatics',
            'Environmental Planning',
            'Construction Management',
            'Real Estate Management',

            // Arts
            'Fine Arts',
            'Music',
            'Theatre Arts',
            'Literature',
            'Film Studies',
            'Graphic Design',
            'Creative Writing',
            'Art History',
            'Dance',
            'Visual Arts',

            // Business
            'Finance',
            'Marketing',
            'Human Resource Management',
            'Accounting',
            'Entrepreneurship',
            'Supply Chain Management',
            'Business Analytics',
            'International Business',
            'Strategic Management',
            'Corporate Governance',

            // Computing and Information Sciences
            'Software Development',
            'Cybersecurity',
            'Data Science',
            'Artificial Intelligence',
            'Computer Networks',
            'Database Management',
            'Web Development',
            'Mobile App Development',
            'Cloud Computing',
            'Machine Learning',

            // Education
            'Curriculum Development',
            'Educational Psychology',
            'Special Needs Education',
            'Early Childhood Education',
            'Educational Leadership',
            'Instructional Design',
            'Adult Education',
            'Educational Technology',
            'Assessment and Evaluation',
            'Teacher Training',

            // Engineering
            'Civil Engineering',
            'Mechanical Engineering',
            'Electrical Engineering',
            'Chemical Engineering',
            'Aerospace Engineering',
            'Biomedical Engineering',
            'Environmental Engineering',
            'Petroleum Engineering',
            'Structural Engineering',
            'Robotics Engineering',

            // Environmental Sciences & Natural Resource Management
            'Environmental Conservation',
            'Forestry',
            'Wildlife Management',
            'Climate Change Studies',
            'Water Resource Management',
            'Marine Biology',
            'Ecotourism',
            'Environmental Impact Assessment',
            'Renewable Energy',
            'Waste Management',

            // Food Science and Nutrition
            'Food Technology',
            'Nutrition and Dietetics',
            'Food Safety',
            'Food Microbiology',
            'Food Chemistry',
            'Food Processing',
            'Public Health Nutrition',
            'Food Quality Assurance',
            'Functional Foods',
            'Sensory Science',

            // GeoScience
            'Geology',
            'Geophysics',
            'Geospatial Science',
            'Mineralogy',
            'Petrology',
            'Hydrology',
            'Oceanography',
            'Meteorology',
            'Remote Sensing',
            'Geotechnical Engineering',

            // Hospitality & Tourism
            'Hotel Management',
            'Tourism Management',
            'Culinary Arts',
            'Event Management',
            'Travel Agency Operations',
            'Hospitality Marketing',
            'Resort Management',
            'Tourism Planning',
            'Cultural Tourism',
            'Sustainable Tourism',

            // Human Health Sciences
            'Nursing',
            'Public Health',
            'Pharmacy',
            'Radiography',
            'Physiotherapy',
            'Dentistry',
            'Clinical Medicine',
            'Epidemiology',
            'Health Informatics',
            'Medical Laboratory Science',

            // Humanities and Social Sciences
            'Sociology',
            'Psychology',
            'Anthropology',
            'Political Science',
            'History',
            'Philosophy',
            'Gender Studies',
            'International Relations',
            'Development Studies',
            'Cultural Studies',

            // Languages
            'Linguistics',
            'Translation',
            'Literary Studies',
            'Language Education',
            'Comparative Literature',
            'Sociolinguistics',
            'Phonetics and Phonology',
            'Language Policy',
            'Second Language Acquisition',
            'Discourse Analysis',

            // Law
            'Corporate Law',
            'Criminal Law',
            'Human Rights Law',
            'Environmental Law',
            'International Law',
            'Commercial Law',
            'Constitutional Law',
            'Labour Law',
            'Intellectual Property Law',
            'Tax Law',

            // Mathematics, Actuarial Science & Economics
            'Pure Mathematics',
            'Applied Mathematics',
            'Actuarial Science',
            'Economics',
            'Financial Mathematics',
            'Operations Research',
            'Mathematical Modeling',
            'Econometrics',
            'Game Theory',
            'Statistics',

            // Physical Education
            'Sports Science',
            'Physical Therapy',
            'Coaching',
            'Exercise Physiology',
            'Sports Psychology',
            'Athletic Training',
            'Sports Management',
            'Rehabilitation Science',
            'Kinesiology',
            'Fitness and Wellness',

            // Religious Studies
            'Theology',
            'Religious Education',
            'Philosophy of Religion',
            'Comparative Religion',
            'Biblical Studies',
            'Islamic Studies',
            'Hinduism Studies',
            'Buddhist Studies',
            'Religious Ethics',
            'Spirituality and Healing',

            // Science
            'Biology',
            'Chemistry',
            'Physics',
            'Biotechnology',
            'Microbiology',
            'Genetics',
            'Astronomy',
            'Environmental Science',
            'Neuroscience',
            'Molecular Biology',

            // Secondary Education Level
            'Mathematics Education',
            'Science Education',
            'Language Education',
            'Social Studies Education',
            'History Education',
            'Geography Education',
            'Religious Education',
            'Physical Education',
            'Business Education',
            'Computer Education',

            // Special Education
            'Inclusive Education',
            'Autism Spectrum Disorders',
            'Hearing Impairments',
            'Visual Impairments',
            'Learning Disabilities',
            'Gifted Education',
            'Behavioral Disorders',
            'Speech and Language Therapy',
            'Early Intervention',
            'Assistive Technology',

            // Technical Training
            'Automotive Engineering',
            'Electrical Installation',
            'Welding and Fabrication',
            'Plumbing',
            'Carpentry',
            'Masonry',
            'Mechanical Maintenance',
            'Refrigeration and Air Conditioning',
            'Instrumentation and Control',
            'Renewable Energy Systems',

            // Textile Technology, Clothing and Fashion Design
            'Fashion Design',
            'Textile Technology',
            'Garment Making',
            'Textile Chemistry',
            'Fashion Marketing',
            'Textile Engineering',
            'Apparel Production',
            'Fashion Merchandising',
            'Textile Design',
            'Sustainable Fashion',
        ];

        foreach ($specialisations as $specialisation) {
            Prof_area_of_specialisation::firstOrCreate(['name' => $specialisation]);
        }
    }
}