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
            $table->integer('idCliente')->unsigned()->nullable();
            $table->integer('idVehiculo')->unsigned();//revisar relación vehículos-tipoVehiculo
            $table->integer('idAgenciaSalida')->unsigned();
            $table->integer('combSalida');
            $table->integer('rendCombSalida');
            $table->integer('odoSalida');
            $table->dateTime('fechaSalida');
            $table->integer('idUsuarioSalida')->unsigned();
            $table->string('firmaClienteSalida', 80)->nullable();
            $table->integer('idAgenciaEntrega')->unsigned()->nullable();
            $table->integer('combEntrega')->nullable();
            $table->integer('rendCombEntrega')->nullable();
            $table->integer('odoEntrega')->nullable();
            $table->dateTime('fechaEntrega')->nullable();
            $table->integer('idUsuarioEntrega')->unsigned()->nullable();
            $table->string('firmaClienteEntrega')->nullable();
            $table->string('nomRecibeVehiculo');
            $table->string('nomEntregaVehiculo')->nullable();
            $table->integer('idEstado')->unsigned();
            $table->dateTime('fechaProceso');

        });

        Schema::table('tblInspecciones', function (Blueprint $table){
            $table->foreign('idCliente')->references('idCliente')->on('tblClientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idVehiculo')->references('idVehiculo')->on('tblVehiculos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idAgenciaSalida')->references('idAgencia')->on('clsAgencias');
            $table->foreign('idUsuarioSalida')->references('idUsuario')->on('tblUsuarios');
            $table->foreign('idAgenciaEntrega')->references('idAgencia')->on('clsAgencias');
            $table->foreign('idUsuarioEntrega')->references('idUsuario')->on('tblUsuarios');
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
