<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Inspecciones.tblInspecciones', function (Blueprint $table) {
            $table->id('idInspeccion')->primary();
            $table->unsignedInteger('idContrato')->nullable(false);
            $table->unsignedInteger('idCliente')->nullable(false);
            $table->unsignedInteger('idVehiculo')->nullable(false);
            $table->unsignedInteger('idAgenciaSalida')->nullable(false);
            $table->unsignedInteger('combSalida')->nullable(false);
            $table->integer('rendCombSalida')->nullable();
            $table->integer('odoSalida')->nullable(false);
            $table->datetime('fechaSalida')->nullable(false);
            $table->integer('idUsuarioSalida')->nullable(false);
            $table->string('firmaClienteSalida', length: 80)->nullable();
            $table->unsignedInteger('idAgenciaEntrega')->nullable();
            $table->unsignedInteger('combEntrega')->nullable();
            $table->integer('rendCombEntrega')->nullable();
            $table->integer('odoEntrega')->nullable();
            $table->dateTime('fechaEntrega')->nullable();
            $table->unsignedInteger('idUsuarioEntrega')->nullable();
            $table->string('firmaClienteEntrega', length: 80)->nullable();
            $table->string('nomRecibeVehiculo', length: 100)->nullable(false);
            $table->string('nomEntregaVehiculo', length: 100)->nullable();
            $table->unsignedInteger('idEstado');
            $table->unsignedInteger('usuarioCreacion')->nullable();
            $table->unsignedInteger('usuarioModificacion')->nullable();
            $table->string('fotoLicencia')->nullable();
            $table->string('comentariosLlantasDelanteras')->nullable();
            $table->string('comentariosLlantasTraseras')->nullable();
            $table->string('comentariosBateria')->nullable();
            $table->timestamps();
        });

        Schema::table('Inspecciones.tblInspecciones', function (Blueprint $table) {
            $table->foreign('idContrato')->references('idContrato')->on('tblContratos');
            $table->foreign('idCliente')->references('idCliente')->on('tblClientes');
            $table->foreign('idVehiculo')->references('idVehiculo')->on('tblVehiculos');
            $table->foreign('idAgenciaSalida')->references('idAgencia')->on('clsAgencias');
            $table->foreign('idAgenciaEntrega')->references('idAgencia')->on('clsAgencias');
            $table->foreign('combSalida')->references('idTanqueComb')->on('clsTanqueComb');
            $table->foreign('combEntrega')->references('idTanqueComb')->on('clsTanqueComb');
            $table->foreign('idUsuarioEntrega')->references('idUsuario')->on('tblUsuarios');
            $table->foreign('idEstado')->references('idEstado')->on('clsEstados');
            $table->foreign('usuarioCreacion')->references('idUsuario')->on('tblUsuarios');
            $table->foreign('usuarioModificacion')->references('idUsuario')->on('tblUsuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Inspecciones.tblInspecciones', function (Blueprint $table) {
            $table->dropForeign('Inspecciones_tblInspecciones_idContrato_foreign');
            $table->dropForeign('Inspecciones_tblInspecciones_idCliente_foreign');
            $table->dropForeign('Inspecciones_tblInspecciones_idVehiculo_foreign');
            $table->dropForeign('Inspecciones_tblInspecciones_idAgenciaSalida_foreign');
            $table->dropForeign('Inspecciones_tblInspecciones_idAgenciaEntrega_foreign');
            $table->dropForeign('Inspecciones_tblInspecciones_combSalida_foreign');
            $table->dropForeign('Inspecciones_tblInspecciones_combEntrega_foreign');
            $table->dropForeign('Inspecciones_tblInspecciones_idUsuarioEntrega_foreign');
            $table->dropForeign('Inspecciones_tblInspecciones_idEstado_foreign');
            $table->dropForeign('Inspecciones_tblInspecciones_usuarioCreacion_foreign');
            $table->dropForeign('Inspecciones_tblInspecciones_usuarioModificacion_foreign');
        });
        Schema::dropIfExists('Inspecciones.tblInspecciones');
    }
};
