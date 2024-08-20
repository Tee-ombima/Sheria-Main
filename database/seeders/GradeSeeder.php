<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    public function run()
    {
        $grades = [
            // O-level/ A-level Grades
            'A',
            'A-',
            'B+',
            'B',
            'B-',
            'C+',
            'C',
            'C-',
            'D+',
            'D',
            'D-',
            'E',

            // Certificate/TRADE TEST, Diploma, Advanced/Higher Diploma, Post Graduate Diploma
            'Pass',
            'Credit',
            'Distinction',

            // Degree Grades
            'First Class Honors',
            'Second Class Honors (Upper Division)',
            'Second Class Honors (Lower Division)',

            // Masters Grades
            'Merit',

            // Doctorate/PhD Grades
            'Fail',  // Typically only Pass/Fail for PhDs
        ];

        foreach ($grades as $grade) {
            Grade::firstOrCreate(['name' => $grade]);
        }
    }
}
