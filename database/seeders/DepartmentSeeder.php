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
            ['name' => 'Legal Affairs', 'email' => 'ombimatitus51@gmail.com'],
    ['name' => 'International Law', 'email' => 'ombimatitus51@gmail.com'],
    ['name' => 'Advocates Complaints Commission', 'email' => 'ombimatitus51@gmail.com'],
    ['name' => 'Government Transactions', 'email' => 'ombimatitus51@gmail.com'],
    ['name' => 'Registrar of Marriages', 'email' => 'ombimatitus51@gmail.com'],
    ['name' => 'Registrar of Societies', 'email' => 'ombimatitus51@gmail.com'],
    ['name' => 'Coat of Arms', 'email' => 'ombimatitus51@gmail.com'],
    ['name' => 'Legislative Drafting', 'email' => 'ombimatitus51@gmail.com'],
    ['name' => 'Legal Advisory and Research', 'email' => 'ombimatitus51@gmail.com'],
    ['name' => 'Civil Litigation', 'email' => 'ombimatitus51@gmail.com'],
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
