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
        Schema::table('Inspecciones.tblInspecciones', function (Blueprint $table) {
            $table->string('correoCliente')->nullable();
            $table->string('correoConductor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropColumn('correoCliente');
            $table->dropColumn('correoConductor');
        });
    }
};
