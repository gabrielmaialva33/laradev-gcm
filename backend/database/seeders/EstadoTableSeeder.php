<?php

namespace Database\Seeders;

use App\Imports\EstadosImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new EstadosImport(), '/xlsx/seed_estado.xlsx', 'local');
    }
}
