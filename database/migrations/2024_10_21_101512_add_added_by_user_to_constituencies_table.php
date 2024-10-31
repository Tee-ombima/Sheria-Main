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
        Schema::table('constituencies', function (Blueprint $table) {
            $table->boolean('added_by_user')->default(false)->after('name');
        });
    }

    public function down()
    {
        Schema::table('constituencies', function (Blueprint $table) {
            $table->dropColumn('added_by_user');
        });
    }
};
