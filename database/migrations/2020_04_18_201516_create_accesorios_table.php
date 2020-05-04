<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clsAccesorios', function (Blueprint $table) {
            $table->increments('idAccesorio');
            $table->string('nomAccesorio', 45)->default(NULL);
            $table->tinyInteger('isActivo')->default(NULL);
            $table->dateTime('fechaIngreso')->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clsAccesorios');
    }
}
