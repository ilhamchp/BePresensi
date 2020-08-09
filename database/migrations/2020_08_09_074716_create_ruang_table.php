<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruang', function (Blueprint $table) {
            $table->string('kd_ruang');
            $table->primary('kd_ruang');
            $table->string('nama_ruang');
            $table->string('kd_beacon');
        });

        Schema::table('ruang', function (Blueprint $table) {
            $table->foreign('kd_beacon')->references('kd_beacon')->on('beacon')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruang');
    }
}
