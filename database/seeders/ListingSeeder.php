<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Listing;
use App\Models\Application;

class ListingSeeder extends Seeder
{
    public function run()
    {
        Listing::factory()
            ->count(10) // Create 10 listings
            ->create()
            ->each(function ($listing) {
                // Create 20 applications for each listing
                Application::factory()
                    ->count(10)
                    ->create(['job_id' => $listing->id]);
            });
    }
}

