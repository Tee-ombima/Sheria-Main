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
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('homecounty_id')->nullable();
            $table->unsignedBigInteger('constituency_id')->nullable();;
            $table->unsignedBigInteger('subcounty_id')->nullable();;
            $table->string('surname', 100)->default('Default');
            $table->string('firstname', 100)->default('Default');
            $table->string('lastname', 100)->nullable();
            $table->string('salutation')->default('Default');
            $table->date('dob')->default('2000-01-01'); // Default date
            $table->string('idno', 8)->default('00000000');
            $table->string('kra_pin', 11)->default('DEFA12345');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('nationality', 50)->default('Default');
            $table->string('ethnicity')->default('Default');
            $table->string('postal_address')->default('Default');
            $table->string('code')->nullable();
            $table->string('town_city', 50)->default('Default');
            $table->string('telephone_num')->nullable();
            $table->string('mobile_num')->default('0000000000');
            $table->string('email_address', 100)->default('default@example.com');
            $table->string('alt_contact_person', 100)->default('Default');
            $table->string('alt_contact_telephone_num')->default('0000000000');
            $table->string('disability_question')->nullable();
            $table->string('nature_of_disability', 100)->nullable();
            $table->string('ncpd_registration_no', 100)->nullable();
            $table->string('ministry', 100)->nullable();
            $table->string('station', 100)->nullable();
            $table->string('personal_employment_number', 100)->nullable();
            $table->string('present_substantive_post', 100)->nullable();
            $table->string('job_grp_scale_grade', 100)->nullable();
            $table->date('date_of_current_appointment')->nullable();
            $table->string('upgraded_post', 100)->nullable();
            $table->date('effective_date_previous_appointment')->nullable();
            $table->string('on_secondment_organization', 100)->nullable();
            $table->string('designation', 100)->nullable();
            $table->string('job_group', 100)->nullable();
            $table->string('terms_of_service')->nullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('homecounty_id')->references('id')->on('homecounties')->onDelete('cascade');
            $table->foreign('constituency_id')->references('id')->on('constituencies')->onDelete('cascade');
            $table->foreign('subcounty_id')->references('id')->on('subcounties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_infos');
    }
};
