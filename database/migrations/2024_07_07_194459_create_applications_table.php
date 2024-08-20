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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('job_id')->nullable();
            $table->string('idno')->default('23457776');
            $table->string('name')->default('default');
            $table->string('job_title')->nullable();
            $table->string('job_reference_number')->nullable();
            $table->text('remarks')->nullable();
            $table->string('job_status')->default('Processing');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('listings')->onDelete('set null');
            $table->unique(['user_id', 'job_id']); // Ensure combination is unique

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
