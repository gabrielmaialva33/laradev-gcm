<?php

namespace Database\Seeders;

use App\Models\Bairro;
use App\Models\Endereco;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnderecosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Endereco::factory(10)->create();

        // -> insert endereco Gonsalves
        $bairro_id = Bairro::getBairroId('codigo_bairro', '1-02');

        DB::table('enderecos')->insert([
            'logradouro' => 'RUA JOÃO PRADO MARGARIDO',
            'numero' => '249',
            'complemento' => '',
            'cep' => '18460-000',
            'codigo_endereco' => '',
            'bairro_id' => $bairro_id,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
