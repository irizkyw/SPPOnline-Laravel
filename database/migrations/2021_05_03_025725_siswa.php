<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Siswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('nisn',15);
            $table->string('nis',10);
            $table->string('nama',64);
            $table->integer('spp_id')->nullable()->unsigned();
            $table->integer('kelas_id')->nullable()->unsigned();
            $table->string('alamat',128);
            $table->char('no_telp',13);
            $table->timestamps();

            $table->foreign('spp_id')->references('id')->on('spp')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
