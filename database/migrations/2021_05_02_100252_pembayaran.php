<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran',function (Blueprint $table){
            $table->increments('id');
            $table->integer('petugas_id')->unsigned();
            $table->string('nisn',15);
            $table->date('tanggal_bayar');
            $table->string('bulan_bayar',15);
            $table->integer('tahun_dibayar');
            $table->integer('spp_id')->unsigned();
            $table->integer('jumlah_bayar');
            $table->string('keterangan',64)->nullable();
            $table->timestamps();
            $table->foreign('petugas_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('spp_id')->references('id')->on('spp')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
