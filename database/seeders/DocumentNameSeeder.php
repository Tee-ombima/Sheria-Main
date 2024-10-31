<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentName;

class DocumentNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documentNames = [
            'ID Card',
            'Passport Photo',
            'Degree Certificate',
            'KCSE Certificate',
            'Birth Certificate',
            'Certificate of Good Conduct',
            'SHIF Card',
            'NSSF Card',
            'KRA PIN Certificate',
            'CV/Resume',
            'Cover letter',
            'Diploma Certificate',
            'Masters certificate',
            'Higher Diploma Certficate',
            'Professional Certificate',
            'Member to professional body Certificate',
            'PHD certificate',
            'Kcpe Certificate',
            'Recommendation Letter',

        ];

        foreach ($documentNames as $documentName) {
            DocumentName::firstOrCreate(['name' => $documentName]);
        }
    }
}
