<?php

namespace Database\Seeders;

use App\Models\DadosPessoais;
use App\Models\Endereco;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GcmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // -> Seed gcm GONÇALVES
        $dados_pessoais_id = DadosPessoais::getDadosPessoaisId(
            'cpf',
            '72042940682'
        );
        $endereco_id = Endereco::getEnderecoId('numero', '249');

        DB::table('gcms')->insert([
            'nome_guerra' => 'GONSALVES',
            'dados_pessoais_id' => $dados_pessoais_id,
            'endereco_id' => $endereco_id,
            'atribuicao' => 'SUB_COMANDANTE',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
