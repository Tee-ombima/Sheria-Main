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
        Schema::create('internship_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->string('phone');
            $table->string('institution');
            $table->string('email');
            $table->string('id_file');
            $table->string('university_letter');
            $table->string('application_letter');
            $table->string('insurance');
            $table->string('good_conduct'); // Add this line
            $table->string('cv'); // Add this line
            $table->string('status')->default('Pending');

            $table->unsignedBigInteger('department_id')->nullable();
        $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            
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
        Schema::dropIfExists('internship_applications');
    }
};
