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
            ['name' => 'Legal Affairs', 'email' => 'legal@company.com'],
            ['name' => 'International Law', 'email' => 'internationallaw@company.com'],
            ['name' => 'Advocates Complaints Commission', 'email' => 'complaints@company.com'],
            ['name' => 'Government Transactions', 'email' => 'transactions@company.com'],
            ['name' => 'Registrar of Marriages', 'email' => 'marriages@company.com'],
            ['name' => 'Registrar of Societies', 'email' => 'societies@company.com'],
            ['name' => 'Coat of Arms', 'email' => 'coatofarms@company.com'],
            ['name' => 'Legislative Drafting', 'email' => 'drafting@company.com'],
            ['name' => 'Legal Advisory and Research', 'email' => 'advisory@company.com'],
            ['name' => 'Civil Litigation', 'email' => 'litigation@company.com'],
        ];

        foreach ($departments as $data) {
            // Create department with name and email
            $department = Department::create([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            // Create 10 internship applications linked to the department
            InternshipApplication::factory()->count(10)->create([
                'department_id' => $department->id, // Assign the created department
                'user_id' => \App\Models\User::factory(), // Create a user for the application
            ]);
        }
    }
}
