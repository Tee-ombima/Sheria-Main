<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Listing;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create "user" and "admin" roles
        putenv('TMPDIR=' . storage_path('app/temp'));

        
        $this->call([
            
        SalutationSeeder::class,               // Seed salutations first
        HomecountySeeder::class,               // Seed home counties before constituencies and subcounties
        ConstituencySeeder::class,             // Seed constituencies after home counties
        SubcountySeeder::class,                // Seed subcounties after constituencies
        EthnicitySeeder::class,                // Seed ethnicities, no dependency on other seeders
        CountryCodeSeeder::class,              // Seed country codes, no dependency on other seeders
        HighschoolSeeder::class,               // Seed high schools, no dependency on other seeders
        CourseSeeder::class,                   // Seed courses, no dependency on other seeders
        SpecialisationSeeder::class,           // Seed specializations, no dependency on other seeders
        ProfAreaOfStudyHighSchoolLevelSeeder::class,  // Seed areas of study at high school level
        ProfAreaOfSpecialisationSeeder::class, // Seed areas of specialisation after areas of study
        ProfAwardSeeder::class,                // Seed professional awards, no dependency on other seeders
        AwardSeeder::class,                    // Seed general awards, no dependency on other seeders
        GradeSeeder::class,                    // Seed grades after awards
        ProfGradeSeeder::class,                // Seed professional grades after awards
        DocumentNameSeeder::class,             // Seed document names, no dependency on other seeders
        ListingSeeder::class,                  // Seed job listings, after users and other essential data
        UserSeeder::class,                     // Seed users after essential data such as salutation, county, etc.
        ApplicationSeeder::class,
        DepartmentSeeder::class,
        FooterTableSeeder::class,
        
        ]);


        // Create a user and assign the "user" role to it
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com'
            
        ]);
        

        // // Create listings associated with the user
        // Listing::factory(6)->create([
        //     'user_id' => $user->id
        // ]);
    }
}
