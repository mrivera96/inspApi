<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DamagePartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Inspecciones.clsPiezasDanio')->insert(
            [
                'descPieza' => 'Bumper Frontal y Tono',
                'usuarioCreacion' => 1,
                'usuarioModificacion' => 1,
            ]);
        DB::table('Inspecciones.clsPiezasDanio')->insert([
            'descPieza' => 'Puerta Frontal RH y Guardafango:',
            'usuarioCreacion' => 1,
            'usuarioModificacion' => 1,
        ]);
        DB::table('Inspecciones.clsPiezasDanio')->insert([
            'descPieza' => 'Puerta Trasera RH y Faldón:',
            'usuarioCreacion' => 1,
            'usuarioModificacion' => 1,
        ]);
        DB::table('Inspecciones.clsPiezasDanio')->insert([
            'descPieza' => 'Bumper Trasero y Compuerta:',
            'usuarioCreacion' => 1,
            'usuarioModificacion' => 1,
        ]);
        DB::table('Inspecciones.clsPiezasDanio')->insert([
            'descPieza' => 'Puerta Trasera LH y Faldón:',
            'usuarioCreacion' => 1,
            'usuarioModificacion' => 1,
        ]);
        DB::table('Inspecciones.clsPiezasDanio')->insert([
            'descPieza' => 'Puerta Delantera LH y Faldón:',
            'usuarioCreacion' => 1,
            'usuarioModificacion' => 1,
        ]);
        DB::table('Inspecciones.clsPiezasDanio')->insert([
            'descPieza' => 'Tablero',
            'usuarioCreacion' => 1,
            'usuarioModificacion' => 1,
        ]);
        DB::table('Inspecciones.clsPiezasDanio')->insert([
            'descPieza' => 'Otras Fotografías ',
            'usuarioCreacion' => 1,
            'usuarioModificacion' => 1,
        ]);
    }
}
