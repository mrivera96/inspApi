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
            $table->string('numInspeccion')->nullable()->after('idInspeccion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Inspecciones.tblInspecciones', function (Blueprint $table) {
            $table->dropColumn('numInspeccion');
        });
    }
};
