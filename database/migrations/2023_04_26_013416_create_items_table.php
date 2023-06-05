<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Createitemstable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name', 100)->nullable($value = true);
            $table->integer('qty')->nullable($value = true);
            $table->date('input_date')->nullable($value = true);
            $table->char('approval_status', 100)->nullable($value = true);
            $table->char('user', 100)->nullable($value = true);
            $table->char('unit', 100)->nullable($value = true);
            $table->char('tipe', 100)->collation('NOCASE')->nullable($value = true);
            $table->char('jenis_transaksi', 100)->nullable($value = true);
            $table->char('bidang', 100)->nullable($value = true);
            $table->char('kelompok', 100)->nullable($value = true);
            $table->char('jenis', 100)->nullable($value = true);
            $table->char('type', 100)->nullable($value = true);
            $table->char('bulan', 100)->nullable($value = true);
            $table->char('kode_barang', 100)->nullable($value = true);
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
        Schema::dropIfExists('items');
    }
};
