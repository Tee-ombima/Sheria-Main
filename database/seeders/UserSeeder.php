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
            'name' => 'Super Admin',
            'email' => 'ombimatitus7@gmail.com',
            'password' => bcrypt('password'), // Use a secure password
            'role' => 'superadmin',
            'permissions' => [
                'manage_users',
                'manage_listings',
                'manage_internships',
                'manage_pupillages',
                'manage_post_pupillages',
                
            ],
        ]);
       
        User::factory()->count(10)->create();
    }
}
