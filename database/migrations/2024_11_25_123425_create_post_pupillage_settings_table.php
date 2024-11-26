<?php
// database/migrations/xxxx_xx_xx_create_post_pupillage_settings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Add this import

class CreatePostPupillageSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('post_pupillage_settings', function (Blueprint $table) {
            $table->id();
            $table->string('vacancy_no')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('post_pupillage_settings')->insert([
            'vacancy_no' => 'VAC12345', // Default vacancy number
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('post_pupillage_settings');
    }
}
