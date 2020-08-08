<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->string('kd_kelas');
            $table->primary('kd_kelas');
            $table->integer('tingkat_kelas');
            $table->string('prodi');
            $table->integer('angkatan');
            
            $table->string('kd_wali_dosen');
        });

        /**
         * Digunakan untuk melakukan 
         * penambahan foreign key
         */
        Schema::table('kelas', function (Blueprint $table) {
            $table->foreign('kd_wali_dosen')->references('kd_dosen')->on('dosen')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
