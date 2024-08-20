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
        Schema::create('prof_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('prof_institution_name', 100)->default('Default Institution');
            $table->string('prof_student_admission_no', 100)->nullable();
            $table->string('prof_area_of_study_high_school_level')->default('Default Area of Study');
            $table->string('prof_area_of_specialisation')->default('Default Specialisation');
            $table->string('prof_award')->default('Default Award');
            $table->string('prof_course', 100)->nullable();
            $table->string('prof_grade', 100)->default('Default Grade');
            $table->string('prof_certificate_no', 100)->nullable();
            $table->date('prof_start_date')->default('2000-01-01'); // Default date
            $table->date('prof_end_date')->default('2000-01-01'); // Default date
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prof_infos');
    }
};
