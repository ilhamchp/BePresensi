<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaAcaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita_acara', function (Blueprint $table) {
            $table->string('kd_berita_acara');
            $table->primary('kd_berita_acara');
            $table->string('kd_jadwal');
            $table->string('desk_perkuliahan')->nullable();
            $table->string('desk_penugasan')->nullable();
            $table->date('tgl_pertemuan');
            $table->integer('mhs_hadir');
            $table->integer('mhs_tidak_hadir');
            $table->time('jam_presensi_dibuka');
        });

        Schema::table('berita_acara', function (Blueprint $table) {
            $table->foreign('kd_jadwal')->references('kd_jadwal')->on('jadwal')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berita_acara');
    }
}
