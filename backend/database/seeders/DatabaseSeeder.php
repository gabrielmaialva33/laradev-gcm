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
        $this->call(EstadoTableSeeder::class);
        $this->call(MunicipioTableSeeder::class);
        $this->call(BairroTableSeeder::class);
    }
}
