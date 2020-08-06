<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTataUsahaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_tata_usaha', function (Blueprint $table) {
            $table->String('kd_staff');
            $table->Primary('kd_staff');
            $table->String('nama_staff');
            $table->String('foto_staff')->default('photo.jpg');

            // unsigned digunakan untuk menandakan kolom tersebut memiliki foreign key
            $table->bigInteger('id_user')->unsigned();
        });

        /**
         * Digunakan untuk melakukan 
         * penambahan foreign key
         */
        Schema::table('staff_tata_usaha', function (Blueprint $table) {
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
        Schema::dropIfExists('staff_tata_usaha');
    }
}
