<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapitulasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekapitulasi', function (Blueprint $table) {
            $table->string('nim');
            $table->primary('nim');
            $table->integer('sakit');
            $table->integer('izin');
            $table->integer('alfa');
            $table->string('kd_status_rekapitulasi');
        });

        Schema::table('rekapitulasi', function (Blueprint $table) {
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kd_status_rekapitulasi')->references('kd_status_rekapitulasi')->on('status_rekapitulasi')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekapitulasi');
    }
}
