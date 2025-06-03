<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Listing;
use App\Models\Application;

class ApplicationSeeder extends Seeder
{
    public function run()
    {
        // Create specific user with full profile
        $specificUser = User::factory()->create([
            'email' => 'ombimatitus51@gmail.com',
            'name' => 'Titus Ombi'
        ]);

        // Create other users with full profiles
        User::factory()
            ->count(9) // Creates 9 more users (total 10)
            ->create();

        // Create job listings
        Listing::factory()->count(10)->create()->each(function ($job) {
            // Get random users with completed profiles
            $users = User::has('personalInfo')
                ->has('academicInfo')
                ->has('profInfo')
                ->has('relevantCourses')
                ->has('attachmentInfo')
                ->inRandomOrder()
                ->limit(100)
                ->get();

            // Create applications
            foreach ($users as $user) {
                Application::factory()->create([
                    'user_id' => $user->id,
                    'job_id' => $job->id,
                    'job_title' => $job->title,
                    'job_reference_number' => $job->job_reference_number
                ]);
            }
        });
    }
}
