<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaniosInspeccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblDaniosInspeccion', function (Blueprint $table) {
            $table->integer('idInspeccion')->unsigned();
            $table->integer('idDanio')->unsigned();
            $table->string('tamanio');
            $table->string('zona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblDaniosInspeccion');
    }
}
