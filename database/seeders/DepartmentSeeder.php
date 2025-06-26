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
            ['name' => 'Department of Public Service and Administration', 'email' => 'ombimatitus51@gmail.com'],
            ['name' => 'Department Of Health Services', 'email' => 'ombimatitus51@gmail.com'],
            ['name' => 'DEPARTMENT OF EDUCATION, SKILLS DEVELOPMENT, YOUTH AND SPORTS', 'email' => 'ombimatitus51@gmail.com'],
            ['name' => 'Department of Trade, Tourism, Industry and Cooperative Development', 'email' => 'ombimatitus51@gmail.com'],
            ['name' => 'Lands, Energy, Housing and Urban Development', 'email' => 'ombimatitus51@gmail.com'],
            ['name' => 'DEPARTMENT OF AGRICULTURE, LIVESTOCK AND FISHERIES DEVELOPMENT', 'email' => 'ombimatitus51@gmail.com'],
            ['name' => 'DEPARTMENT OF CULTURE, GENDER AND SOCIAL SERVICES', 'email' => 'ombimatitus51@gmail.com'],
            ['name' => 'THE DEPARTMENT OF ROADS, TRANSPORT & PUBLIC WORKS', 'email' => 'ombimatitus51@gmail.com'],
            ['name' => 'Department of Finance and Economic Planning', 'email' => 'ombimatitus51@gmail.com'],
        ];

        foreach ($departments as $data) {
            // Create department with name and email
            $department = Department::create([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            // Create 10 internship applications linked to the department
            InternshipApplication::factory()->count(10)->create([
                'department_id' => $department->id,
                'user_id' => \App\Models\User::factory(),
            ]);
        }
    }
}
