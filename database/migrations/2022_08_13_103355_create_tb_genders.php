<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('tb_genders', function (Blueprint $table) {
            $table->id('gen_id');
            $table->string('gen_gender', 50);
            $table->boolean('gen_visible')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_genders');
    }
};
