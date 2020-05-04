<?php

use Illuminate\Database\Seeder;

class clsTipoEstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('clsTipoEstados')->insert([
            'descTipoEstado' => 'Inspecciones'
        ]);
    }
}
