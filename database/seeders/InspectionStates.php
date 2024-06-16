<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InspectionStates extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clsEstados')->insert(
            [
                'descPieza' => 'Bumper Frontal y Tono',
                'usuarioCreacion' => 1,
                'usuarioModificacion' => 1,
            ]);
    }
}
