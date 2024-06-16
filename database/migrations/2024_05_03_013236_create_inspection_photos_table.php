<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Inspecciones.tblFotosInspeccion', function (Blueprint $table) {
            $table->id('idFoto')->primary();
            $table->unsignedBigInteger('idInspeccion')->nullable(false);
            $table->unsignedBigInteger('idPieza')->nullable(false);
            $table->text('foto')->nullable();
            $table->string('etapa')->nullable();
            $table->unsignedInteger('usuarioCreacion')->nullable();
            $table->unsignedInteger('usuarioModificacion')->nullable();
            $table->timestamps();
        });

        Schema::table('Inspecciones.tblFotosInspeccion', function (Blueprint $table) {
            $table->foreign('idInspeccion')->references('idInspeccion')->on('Inspecciones.tblInspecciones');
            $table->foreign('idPieza')->references('idPieza')->on('Inspecciones.clsPiezasVehiculo');
            $table->foreign('usuarioCreacion')->references('idUsuario')->on('tblUsuarios');
            $table->foreign('usuarioModificacion')->references('idUsuario')->on('tblUsuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Inspecciones.tblFotosInspeccion', function (Blueprint $table) {
            $table->dropForeign('Inspecciones_tblFotosInspeccion_idInspeccion_foreign');
            $table->dropForeign('Inspecciones_tblFotosInspeccion_idPieza_foreign');
            $table->dropForeign('Inspecciones_tblFotosInspeccion_usuarioCreacion_foreign');
            $table->dropForeign('Inspecciones_tblFotosInspeccion_usuarioModificacion_foreign');
        });
        Schema::dropIfExists('Inspecciones.tblFotosInspeccion');
    }
};
