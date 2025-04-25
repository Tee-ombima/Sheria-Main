<?php

namespace Database\Seeders;
use App\Models\DeploymentRegion;
use Illuminate\Database\Seeder;

class DeploymentRegionSeeder extends Seeder
{
    public function run()
    {
        $regions = [
            ['name' => 'Nakuru', 'slug' => 'nakuru'],
            ['name' => 'Kisii', 'slug' => 'kisii'],
            ['name' => 'Mombasa', 'slug' => 'mombasa'],
            ['name' => 'Kisumu', 'slug' => 'kisumu'],
            ['name' => 'Kericho', 'slug' => 'kericho'],
            ['name' => 'Embu', 'slug' => 'embu'],
            ['name' => 'Nyeri', 'slug' => 'nyeri'],
            ['name' => 'Kakamega', 'slug' => 'kakamega'],
            ['name' => 'Malindi', 'slug' => 'malindi'],
            ['name' => 'Eldoret', 'slug' => 'eldoret'],
            ['name' => 'Meru', 'slug' => 'meru'],
            ['name' => 'Garissa', 'slug' => 'garissa'],
            ['name' => 'Machakos', 'slug' => 'machakos'],
        ];

        foreach ($regions as $region) {
            DeploymentRegion::firstOrCreate(
                ['slug' => $region['slug']],
                $region
            );
        }
    }
}
