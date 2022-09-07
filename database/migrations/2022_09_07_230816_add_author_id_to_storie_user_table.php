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
        Schema::table('storie_user', function (Blueprint $table) {
            $table->integer('author_id');
            $table->string('author_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('storie_user', function (Blueprint $table) {
            $table->dropCollumn('author_id');
            $table->dropCollumn('author_name');
        });
    }
};
