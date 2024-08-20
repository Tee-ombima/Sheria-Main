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
        Schema::create('academic_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('institution_name', 100)->default('Default Institution');
            $table->string('student_admission_no', 100)->nullable();
            $table->string('highschool')->default('Default Highschool');
            $table->string('specialisation')->default('Default Specialisation');
            $table->string('award')->default('Default Award');
            $table->string('course')->default('Default Course');
            $table->string('grade', 100)->default('Default Grade');
            $table->string('certificate_no', 100)->default('Default Certificate No');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('graduation_completion_date')->nullable();
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
        Schema::dropIfExists('academic_infos');
    }
};
