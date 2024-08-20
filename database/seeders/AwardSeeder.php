<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Award;

class AwardSeeder extends Seeder
{
    public function run()
    {
        $awards = [
            'First Class Honors',
            'Second Class Honors (Upper Division)',
            'Second Class Honors (Lower Division)',
            'Pass',
            'Distinction',
            'Credit',
            'Merit',
            'High Pass',
            'Fail',
            'Diploma',
        ];

        foreach ($awards as $award) {
            Award::firstOrCreate(['name' => $award]);
        }
    }
}
