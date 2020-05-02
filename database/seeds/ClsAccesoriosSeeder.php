<?php

use Illuminate\Database\Seeder;

class ClsAccesoriosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * volcado de datos para la tabla de accesorios
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('clsAccesorios')->insert([
            ['nomAccesorio' => 'Alfombras',           'isActivo' => 1, 'fechaIngreso' => \Carbon\Carbon::now()],
            ['nomAccesorio' => 'Permiso',             'isActivo' => 1, 'fechaIngreso' => \Carbon\Carbon::now()],
            ['nomAccesorio' => 'Antena',              'isActivo' => 1, 'fechaIngreso' => \Carbon\Carbon::now()],
            ['nomAccesorio' => 'Gata',                'isActivo' => 1, 'fechaIngreso' => \Carbon\Carbon::now()],
            ['nomAccesorio' => 'Tapon de Gasolina',   'isActivo' => 1, 'fechaIngreso' => \Carbon\Carbon::now()],
            ['nomAccesorio' => 'Maneral',             'isActivo' => 1, 'fechaIngreso' => \Carbon\Carbon::now()],
            ['nomAccesorio' => 'Extintor',            'isActivo' => 1, 'fechaIngreso' => \Carbon\Carbon::now()],
            ['nomAccesorio' => 'Llaves',              'isActivo' => 1, 'fechaIngreso' => \Carbon\Carbon::now()],
            ['nomAccesorio' => 'Llanta de Repuesto',  'isActivo' => 1, 'fechaIngreso' => \Carbon\Carbon::now()],
            ['nomAccesorio' =>  'Destornillador',     'isActivo' => 1, 'fechaIngreso' => \Carbon\Carbon::now()],
            ['nomAccesorio' =>  'Tenazas',            'isActivo' => 1, 'fechaIngreso' => \Carbon\Carbon::now()],
            ['nomAccesorio' =>  'Triangulo',          'isActivo' => 1, 'fechaIngreso' => \Carbon\Carbon::now()],
            ['nomAccesorio' =>  'Llave de Rueda',     'isActivo' => 1, 'fechaIngreso' => \Carbon\Carbon::now()]
        ]);
    }
}
