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
        Schema::create('pupillages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Personal Details
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->string('identity_card_number');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('nationality');
            $table->string('ethnicity');
            $table->string('home_county');
            $table->string('sub_county');
            $table->boolean('disability_status');
            $table->string('nature_of_disability')->nullable();

            // Contact Details
            $table->string('postal_address');
            $table->string('postal_code');
            $table->string('town');
            $table->string('physical_address');
            $table->string('mobile_number');
            $table->string('alternate_mobile_number')->nullable();
            $table->string('email_address');

            // Academic Qualification
            // KSCE Grade
        $table->string('ksce_grade')->nullable();
        $table->string('other_ksce_grade')->nullable();

        // Institution Name
        $table->string('institution_name')->nullable();
        $table->string('other_institution_name')->nullable();

        // Institution Grade
        $table->string('institution_grade')->nullable();
        $table->string('other_institution_grade')->nullable();
            $table->boolean('declaration');

            $table->string('status')->default('Pending');
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('pupillages');
    }
};
