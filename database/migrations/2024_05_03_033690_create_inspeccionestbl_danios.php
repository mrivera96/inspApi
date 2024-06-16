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
        Schema::create('Inspecciones.tblDaniosInspeccion', function (Blueprint $table) {
            $table->id('idDanio')->primary();
            $table->unsignedBigInteger('idInspeccion')->nullable(false);
            $table->unsignedBigInteger('idPieza')->nullable(false);
            $table->unsignedBigInteger('idTipoDanio')->nullable(false);
            $table->unsignedBigInteger('idFoto')->nullable();
            $table->string('etapa')->nullable();
            $table->unsignedInteger('usuarioCreacion')->nullable();
            $table->unsignedInteger('usuarioModificacion')->nullable();
            $table->timestamps();
        });

        Schema::table('Inspecciones.tblDaniosInspeccion', function (Blueprint $table) {
            $table->foreign('idInspeccion')->references('idInspeccion')->on('Inspecciones.tblInspecciones');
            $table->foreign('idPieza')->references('idPieza')->on('Inspecciones.clsPiezasVehiculo');
            $table->foreign('idTipoDanio')->references('idTipoDanio')->on('Inspecciones.clsTiposDanio');
            $table->foreign('idFoto')->references('idFoto')->on('Inspecciones.tblFotosInspeccion');
            $table->foreign('usuarioCreacion')->references('idUsuario')->on('tblUsuarios');
            $table->foreign('usuarioModificacion')->references('idUsuario')->on('tblUsuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Inspecciones.tblDaniosInspeccion', function (Blueprint $table) {
            $table->dropForeign('Inspecciones_tblDaniosInspeccion_idInspeccion_foreign');
            $table->dropForeign('Inspecciones_tblDaniosInspeccion_idPieza_foreign');
            $table->dropForeign('Inspecciones_tblDaniosInspeccion_idTipoDanio_foreign');
            $table->dropForeign('Inspecciones_tblDaniosInspeccion_idFoto_foreign');
            $table->dropForeign('Inspecciones_tblDaniosInspeccion_usuarioCreacion_foreign');
            $table->dropForeign('Inspecciones_tblDaniosInspeccion_usuarioModificacion_foreign');
        });
        Schema::dropIfExists('Inspecciones.tblDaniosInspeccion');
    }
};
