<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InstitutionGrade;

class InstitutionGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = ['First Class Honors', 'Second Class Upper', 'Second Class Lower', 'Pass'];

        foreach ($grades as $grade) {
            InstitutionGrade::create(['grade' => $grade]);
        }
    }
}
