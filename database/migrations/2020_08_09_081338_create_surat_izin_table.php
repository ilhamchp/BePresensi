<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratIzinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_izin', function (Blueprint $table) {
            $table->string('kd_surat_izin');
            $table->primary('kd_surat_izin');
            $table->char('kd_jenis_izin');
            $table->string('nim');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->time('jam_mulai')->default('00:00:01');
            $table->time('jam_selesai')->default('23:59:59');
            $table->bigInteger('kd_status_surat')->unsigned();
            $table->string('catatan_surat')->nullable();
            $table->string('catatan_wali_dosen')->nullable();
            $table->string('foto_surat');
        });

        Schema::table('surat_izin', function (Blueprint $table) {
            $table->foreign('kd_jenis_izin')->references('kd_status_presensi')->on('status_presensi')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kd_status_surat')->references('kd_status_surat')->on('status_surat')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_izin');
    }
}
