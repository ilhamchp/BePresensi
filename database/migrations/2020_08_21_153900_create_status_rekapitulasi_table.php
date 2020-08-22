<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusRekapitulasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_rekapitulasi', function (Blueprint $table) {
            $table->string('kd_status_rekapitulasi');
            $table->primary('kd_status_rekapitulasi');
            $table->string('keterangan_rekapitulasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_rekapitulasi');
    }
}
