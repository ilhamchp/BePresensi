<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->string('kd_jadwal');
            $table->primary('kd_jadwal');
            $table->string('kd_kelas');
            $table->integer('kd_hari');
            $table->integer('kd_sesi_mulai');
            $table->integer('kd_sesi_berakhir');
            $table->string('kd_ruang');
            $table->string('kd_matakuliah');
            $table->string('kd_dosen_pengajar');
            $table->string('jenis_perkuliahan');
            $table->boolean('sesi_presensi_dibuka')->default(false);
            $table->integer('toleransi_keterlambatan')->default('10');
        });

        Schema::table('jadwal', function (Blueprint $table) {
            $table->foreign('kd_kelas')->references('kd_kelas')->on('kelas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kd_hari')->references('kd_hari')->on('hari')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kd_sesi_mulai')->references('kd_sesi')->on('sesi')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kd_sesi_berakhir')->references('kd_sesi')->on('sesi')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kd_ruang')->references('kd_ruang')->on('ruang')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kd_matakuliah')->references('kd_matakuliah')->on('matakuliah')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kd_dosen_pengajar')->references('kd_dosen')->on('dosen')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
}
