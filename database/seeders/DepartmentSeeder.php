<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\InternshipApplication;
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
            // Create the department
            $createdDepartment = Department::create(['name' => $department]);

            // Create 30 applicants for each department
            InternshipApplication::factory()->count(30)->create([
                'department_id' => $createdDepartment->id, // Assign the created department
                'user_id' => \App\Models\User::factory(), // Create a user for the application
            ]);
        }
    }
}
