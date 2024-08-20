<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            'Bachelor of Science in Computer Science',
            'Bachelor of Business Administration',
            'Bachelor of Arts in Communication',
            'Bachelor of Education',
            'Bachelor of Laws',
            'Bachelor of Medicine and Surgery',
            'Bachelor of Science in Nursing',
            'Bachelor of Engineering',
            'Diploma in Information Technology',
            'Diploma in Business Management',
        ];

        foreach ($courses as $course) {
            Course::firstOrCreate(['name' => $course]);
        }
    }
}
