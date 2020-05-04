<?php

use Illuminate\Database\Seeder;

class clsEstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('clsEstados')->insert([
            ['idTipoEstado' => 8, 'descEstado' => 'Abierta', 'isActivo' => 1, 'fechaAlta' => \Carbon\Carbon::now()] ,
            ['idTipoEstado' => 8,'descEstado' => 'Cerrada', 'isActivo' => 1, 'fechaAlta' => \Carbon\Carbon::now() ],
            ['idTipoEstado' => 8,'descEstado' => 'Anulada', 'isActivo' => 1, 'fechaAlta' => \Carbon\Carbon::now()]
        ]);
    }
}
