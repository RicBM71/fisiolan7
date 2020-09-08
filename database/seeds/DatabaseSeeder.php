<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // eliminar resticciones foreign-keys
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(UsersTableSeeder::class);
        $this->call(GenericasSeeder::class);
        $this->call(BancosTableSeeder::class);
        $this->call(TratamientosSeeder::class);
        $this->call(EmpleadosSeeder::class);
        $this->call(MutuasSeeder::class);
        $this->call(AreasSeeder::class);
        $this->call(CajasSeeder::class);
        $this->call(PacientesSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
