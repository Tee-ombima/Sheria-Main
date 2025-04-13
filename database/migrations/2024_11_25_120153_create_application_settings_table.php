<?php
// database/migrations/xxxx_xx_xx_create_application_settings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Add this import

class CreateApplicationSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('application_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('internship_applications_enabled')->default(true);

            $table->boolean('pupillage_applications_enabled')->default(true);
            $table->boolean('post_pupillage_applications_enabled')->default(true);
            $table->integer('max_pending_applications')->default(100);
            $table->integer('max_pupillage_applications')->default(100);
            $table->integer('max_postpupillage_applications')->default(100);


            $table->timestamps();
        });

        // Insert default settings
        DB::table('application_settings')->insert([
            'internship_applications_enabled' => true,

            'pupillage_applications_enabled' => true,
            'post_pupillage_applications_enabled' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('application_settings');
    }
}
