<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Footer;

class FooterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Footer::create([
            'contact_info' => 'Contact: +123 456 7890 | info@example.com',
            'vision' => 'Vision: To be the leading provider of quality services.',
            'mission' => 'Mission: To innovate and provide exceptional service to our clients.',
        ]);
    }
}
