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
    Schema::table('pupillages', function (Blueprint $table) {
        $table->string('are_you_employed')->nullable();
        $table->string('employer_institution_name')->nullable();
        $table->decimal('gross_salary', 10, 2)->nullable();
    });
}

public function down()
{
    Schema::table('pupillages', function (Blueprint $table) {
        $table->dropColumn('are_you_employed');
        $table->dropColumn('employer_institution_name');
        $table->dropColumn('gross_salary');
    });
}

};
