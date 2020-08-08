<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nim');
            $table->primary('nim');
            $table->string('nama_mahasiswa');
            $table->string('foto_mahasiswa');
            $table->string('kd_kelas');
            $table->bigInteger('id_user')->unsigned();
        });

        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->foreign('kd_kelas')->references('kd_kelas')->on('kelas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}
