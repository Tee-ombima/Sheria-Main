<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('country_codes', function (Blueprint $table) {
        $table->id();
        $table->string('code'); // For storing the country code, e.g., +254
        $table->string('name')->default('Kenya');// For storing the country name, e.g., Kenya
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_codes');
    }
};
