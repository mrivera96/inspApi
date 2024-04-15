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
        Schema::create('Inspecciones.tblAccesoriosInspeccion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idInspeccion')->nullable(false);
            $table->unsignedInteger('idAccesorio')->nullable(false);
            $table->integer('cantidad')->nullable();
            $table->timestamps();
        });

        Schema::table('Inspecciones.tblAccesoriosInspeccion', function (Blueprint $table) {
            $table->foreign('idInspeccion')->references('idInspeccion')->on('Inspecciones.tblInspecciones');
            $table->foreign('idAccesorio')->references('idAccesorio')->on('clsAccesorios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Inspecciones.tblAccesoriosInspeccion', function (Blueprint $table) {
            $table->dropForeign('Inspecciones_tblAccesoriosInspeccion_idInspeccion_foreign');
            $table->dropForeign('Inspecciones_tblAccesoriosInspeccion_idAccesorio_foreign');
        });
        Schema::dropIfExists('Inspecciones.tblAccesoriosInspeccion');
    }
};
