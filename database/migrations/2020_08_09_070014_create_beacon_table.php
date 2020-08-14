<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeaconTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beacon', function (Blueprint $table) {
            $table->string('kd_beacon');
            $table->primary('kd_beacon');
            $table->string('mac_address')->unique();
            $table->string('major');
            $table->string('minor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beacon');
    }
}
