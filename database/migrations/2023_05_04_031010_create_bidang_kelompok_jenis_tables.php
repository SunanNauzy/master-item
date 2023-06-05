<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidangKelompokJenisTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidangs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('kelompoks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('bidang_id');
            $table->timestamps();
        });

        Schema::create('jeniss', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('kelompok_id');
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
        Schema::dropIfExists('bidangs');
        Schema::dropIfExists('kelompoks');
        Schema::dropIfExists('jeniss');
    }
}
