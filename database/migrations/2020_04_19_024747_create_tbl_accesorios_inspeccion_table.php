<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAccesoriosInspeccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_accesorios_inspeccion', function (Blueprint $table) {
            $table->integer('idInspeccion')->unsigned();
            $table->integer('idAccesorio')->unsigned();
            $table->string('tipo', 2);
            $table->integer('cantidad');
            $table->timestamps();
        });

        Schema::table('tbl_accesorios_inspeccion', function (Blueprint $table){
            $table->foreign('idInspeccion')->references('idInspeccion')->on('tblInspecciones')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idAccesorio')->references('idAccesorio')->on('clsAccesorios')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_accesorios_inspeccion');
    }
}
