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
        Schema::create('Inspecciones.clsPiezasVehiculo', function (Blueprint $table) {
            $table->id('idPieza')->primary();
            $table->string('descPieza', length: 150)->nullable(false);
            $table->boolean('isActivo')->default(true);
            $table->unsignedInteger('usuarioCreacion')->nullable();
            $table->unsignedInteger('usuarioModificacion')->nullable();
            $table->timestamps();
            $table->integer('orden')->nullable();
        });

        Schema::table('Inspecciones.clsPiezasVehiculo', function (Blueprint $table) {
            $table->foreign('usuarioCreacion')->references('idUsuario')->on('tblUsuarios');
            $table->foreign('usuarioModificacion')->references('idUsuario')->on('tblUsuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Inspecciones.clsPiezasVehiculo', function (Blueprint $table) {
            $table->dropForeign('Inspecciones_clsPiezasVehiculo_usuarioCreacion_foreign');
            $table->dropForeign('Inspecciones_clsPiezasVehiculo_usuarioModificacion_foreign');
        });
        Schema::dropIfExists('Inspecciones.clsPiezasVehiculo');
    }
};
