<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->String('kd_dosen');
            $table->Primary('kd_dosen');
            $table->String('nama_dosen');
            $table->String('foto_dosen')->default('photo.jpg');

            // unsigned digunakan untuk menandakan kolom tersebut memiliki foreign key
            $table->bigInteger('id_user')->unsigned();
        });

        /**
         * Digunakan untuk melakukan 
         * penambahan foreign key
         */
        Schema::table('dosen', function (Blueprint $table) {
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
        Schema::dropIfExists('dosen');
    }
}
