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
        Schema::create('post_pupillages', function (Blueprint $table) {
            $table->id();

            // Foreign key to users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Personal Details
            $table->string('vacancy_no');
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->string('identity_card_number');
            $table->string('gender');
            $table->string('kra_pin');
            $table->string('nhif_card_number');
            $table->string('postal_address');
            $table->string('postal_code');
            $table->string('town');
            $table->string('email_address');
            $table->string('mobile_number');
            $table->string('home_county');
            $table->string('sub_county');
            $table->string('ethnicity');
            $table->boolean('disability_status');
            $table->string('nature_of_disability')->nullable();


            // Deployment Region
            $table->string('deployment_region');

            // Declaration
            $table->boolean('declaration');

            // Application Status
            $table->string('status')->default('Pending');
            $table->text('remarks')->nullable();
            $table->boolean('deleted_by_admin')->default(false);
        $table->softDeletes();

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
        Schema::dropIfExists('post_pupillages');
    }
};
