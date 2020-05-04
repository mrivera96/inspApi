<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClsAccesoriosSeeder::class);
        $this->call(clsTipoEstadosSeeder::class);
        $this->call(clsEstadosSeeder::class);
    }
}
