<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        // Create one user with the specified email and role as admin
        User::factory()->create([
            'name' => fake()->name(), // Generate a random name
            'email' => 'obititan21@gmail.com', // Specific email
            'email_verified_at' => now(),
            'role' => 'admin', // Admin role
            'password' => bcrypt('password'), // Password for the user
        ]);

        User::factory()->count(100)->create();
    }
}
