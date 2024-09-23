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
            'NHIF Card',
            'NSSF Card',
            'KRA PIN Certificate',
            'CV/Resume',
            'Cover letter',
        ];

        foreach ($documentNames as $documentName) {
            DocumentName::firstOrCreate(['name' => $documentName]);
        }
    }
}
