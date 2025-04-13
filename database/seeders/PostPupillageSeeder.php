<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\PostPupillage;
use App\Models\User;

class PostPupillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $users = User::factory()->count(90)->create();

        foreach ($users as $user) {
            PostPupillage::factory()->create([
                'user_id' => $user->id,
                'email_address' => $user->email
            ]);
        }
    }
}
