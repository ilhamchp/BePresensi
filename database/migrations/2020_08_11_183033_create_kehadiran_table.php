<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKehadiranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id('kd_kehadiran');
            $table->string('nim');
            $table->string('kd_jadwal');
            $table->integer('kd_sesi');
            $table->char('kd_status_presensi');
            $table->string('kd_surat_izin')->nullable();
            $table->date('tgl_presensi')->nullable();
            $table->time('jam_presensi')->nullable();
        });

        Schema::table('kehadiran', function (Blueprint $table) {
            $table->foreign('kd_surat_izin')->references('kd_surat_izin')->on('surat_izin')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kehadiran');
    }
}
