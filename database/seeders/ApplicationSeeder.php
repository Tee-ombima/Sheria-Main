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
        // Ensure the specific users are included in the 3,000 users
        $specificUsers = [
            
            ['email' => 'ombimatitus51@gmail.com'],
        ];

        // Create the specific users if they don't exist already
        foreach ($specificUsers as $specificUser) {
            User::firstOrCreate($specificUser, [
                'name' => fake()->name,  // Generate a random name for the specific users
                'email_verified_at' => now(),
                'password' => bcrypt('password'),  // Assign a random password or a default
            ]);
        }

        // Generate the remaining users to reach 10,000 in total
        $totalUsersNeeded = 10 - count($specificUsers); // Subtract specific users from 10,000
        User::factory()->count($totalUsersNeeded)->create();

        // Get all the users from the database, including the specific ones
        $users = User::all();

        // Create 10 job listings
        Listing::factory()->count(10)->create()->each(function ($job) use ($users, $specificUsers) {

            // Assign specific users to random jobs
            foreach ($specificUsers as $specificUser) {
                $user = User::where('email', $specificUser['email'])->first(); // Get the user by email
                Application::firstOrCreate([
                    'user_id' => $user->id,
                    'job_id' => $job->id,
                ], [
                    'job_title' => $job->title,
                    'job_reference_number' => $job->job_reference_number,
                ]);
            }

            // Ensure at least 1500 users apply to each job
            $currentApplicantCount = Application::where('job_id', $job->id)->count();
            $remainingApplicants = 10 - $currentApplicantCount;

            // Select enough users to fill in the remaining slots
            if ($remainingApplicants > 0) {
                $randomUsers = $users->random($remainingApplicants); // Randomly pick users from the 10,000

                // Assign remaining users to this job listing
                foreach ($randomUsers as $user) {
                    Application::firstOrCreate([
                        'user_id' => $user->id,
                        'job_id' => $job->id,
                    ], [
                        'job_title' => $job->title,
                        'job_reference_number' => $job->job_reference_number,
                    ]);
                }
            }
        });
    }
}
