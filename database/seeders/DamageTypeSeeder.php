<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DamageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Inspecciones.clsTiposDanio')->insert(
            [
                'descTipoDanio' => 'Rayón',
                'usuarioCreacion' => 1,
                'usuarioModificacion' => 1,
                'orden' => 1
            ]);

        DB::table('Inspecciones.clsTiposDanio')->insert(
            [
                'descTipoDanio' => 'Hendidura',
                'usuarioCreacion' => 1,
                'usuarioModificacion' => 1,
                'orden' => 2
            ]);

        DB::table('Inspecciones.clsTiposDanio')->insert(
            [
                'descTipoDanio' => 'Roce',
                'usuarioCreacion' => 1,
                'usuarioModificacion' => 1,
                'orden' => 3
            ]);

        DB::table('Inspecciones.clsTiposDanio')->insert(
            [
                'descTipoDanio' => 'Hundimiento',
                'usuarioCreacion' => 1,
                'usuarioModificacion' => 1,
                'orden' => 1
            ]);
        DB::table('Inspecciones.clsTiposDanio')->insert(
            [
                'descTipoDanio' => 'Abolladura',
                'usuarioCreacion' => 1,
                'usuarioModificacion' => 1,
                'orden' => 1
            ]);
    }
}
