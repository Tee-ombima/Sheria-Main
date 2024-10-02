<?php

namespace Database\Seeders;
use App\Models\Department;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            'Legal Affairs',
            'International Law',
            'Advocates Complaints Commission',
            'Government Transactions',
            'Registrar of Marriages',
            'Registrar of Societies',
            'Coat of Arms',
            'Legislative Drafting',
            'Legal Advisory and Research',
            'Civil Litigation',
        ];

        foreach ($departments as $department) {
            Department::create(['name' => $department]);
        }
    }
}
