<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblInspecciones', function (Blueprint $table) {
            $table->increments('idInspeccion');
            //$table->string('numContrato', 20)->unsigned();
            $table->integer('idCliente')->unsigned();
            $table->integer('idVehiculo')->unsigned();//revisar relación vehículos-tipoVehiculo
            $table->integer('idAgenciaSalida')->unsigned();
            $table->integer('comSalida');
            $table->integer('redCombSalida');
            $table->integer('odoSalida');
            $table->dateTime('fechaSalida');
            $table->integer('idUsuarioSalida')->unsigned();
            $table->string('firmaClienteSalida', 80);
            $table->string('obsSalida');
            $table->integer('idAgenciaEntrega')->unsigned();
            $table->integer('combEntrega');
            $table->integer('rendCombEntrega');
            $table->integer('odoEntrega');
            $table->dateTime('fechaEntrega');
            $table->integer('idUsuarioEntrega')->unsigned();
            $table->string('firmaClienteEntrega');
            $table->string('obsEntrega');
            $table->string('nomRecibeVehiculo');
            $table->string('nomEntregaVehiculo');
            $table->integer('idEstado')->unsigned();
            $table->dateTime('fechaProceso');

            $table->timestamps();
        });

        Schema::table('tblInspecciones', function (Blueprint $table){
            $table->foreign('idCliente')->references('idCliente')->on('tblClientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idVehiculo')->references('idVehiculo')->on('tblVehiculos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idAgenciaSalida')->references('idAgencia')->on('clsAgencias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idUsuarioSalida')->references('idUsuario')->on('tblUsuarios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idAgenciaEntrega')->references('idAgencia')->on('clsAgencias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idUsuarioEntrega')->references('idUsuario')->on('tblUsuarios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idEstado')->references('idEstado')->on('clsEstados')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblInspecciones');
    }
}
