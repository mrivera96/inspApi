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
                'descPieza' => 'Otras Fotografías ',
                'usuarioCreacion' => 1,
                'usuarioModificacion' => 1,
            ]

        );
    }
}
