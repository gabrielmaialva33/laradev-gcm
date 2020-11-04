<?php

namespace Database\Seeders;

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
        $this->call(EstadosTableSeeder::class);
        $this->call(MunicipiosTableSeeder::class);
        $this->call(BairrosTableSeeder::class);
        $this->call(EnderecosTableSeeder::class);
        $this->call(DadosPessoaisTableSeeder::class);
        $this->call(GcmsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
