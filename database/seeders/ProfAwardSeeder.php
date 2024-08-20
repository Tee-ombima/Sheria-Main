<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prof_award;

class ProfAwardSeeder extends Seeder
{
    public function run()
    {
        $awards = [
            'Certificate (O-level/ A-level)',
            'Certificate/TRADE TEST',
            'Diploma',
            'Advanced/Higher Diploma',
            'Degree',
            'Post Graduate Diploma',
            'Masters',
            'Doctorate/PhD',
        ];

        foreach ($awards as $award) {
            Prof_award::firstOrCreate(['name' => $award]);
        }
    }
}
