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
        Schema::create('sub_countyps', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('county_id');
        $table->string('name');
        $table->timestamps();

        $table->foreign('county_id')->references('id')->on('countyps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_countyps');
    }
};
