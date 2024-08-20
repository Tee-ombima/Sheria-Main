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
        // Create a specific job listing that users will apply to
        $job = Listing::factory()->create([
            'title' => 'Software Developer',
            'job_reference_number' => 'DEV/2024/1',
        ]);
        // Create specific users with the given email addresses
        $specificUsers = [
            ['email' => 'ombimatitus7@gmail.com'],
            ['email' => 'ombimatitus51@gmail.com'],
        ];

        foreach ($specificUsers as $specificUser) {
            $user = User::factory()->create($specificUser);
            Application::factory()->create([
                'user_id' => $user->id,
                'job_id' => $job->id,
                'job_title' => $job->title,
                'job_reference_number' => $job->job_reference_number,
            ]);
        }

        // Create 50 users and have each one apply to the same job
        User::factory()->count(50)->create()->each(function ($user) use ($job) {
            Application::factory()->create([
                'user_id' => $user->id,
                'job_id' => $job->id,
                'job_title' => $job->title,
                'job_reference_number' => $job->job_reference_number,
            ]);
        });
    }
}

