<?php

namespace Database\Seeders;

use App\Models\Municipio;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DadosPessoaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // -> Seed dados pessoais GCM GONÇALVES
        $municipio_nascimento_id = Municipio::getMunicipioId(
            'codigo_ibge',
            '3113503'
        );

        DB::table('dados_pessoais')->insert([
            'nome' => 'SEBASTIÃO ADEMAR GONÇALVES',
            'rg' => '377953611',
            'cpf' => '72042940682',
            'telefone' => json_encode(['1535314445', '15996962874']),
            'nome_mae' => 'JOSÉ GONÇALVES ROSA',
            'nome_pai' => 'SEBASTIANA ROSA DOS SANTOS',
            'data_nascimento' => Carbon::parse('1971-08-13'),
            'municipio_nascimento_id' => $municipio_nascimento_id,
            'sexo' => 'MASCULINO',
            'cutis' => 'BRANCO',
            'tipo_sanguineo' => 'O+',
            'estado_civil' => 'CASADO',
            'profissao' => 'GCM',
            'escolaridade' => 'FUNDAMENTAL-COMPLETO',
            'nome_conjuge' => 'GONÇALVES',
            'nome_filhos' => json_encode([
                'VITORIA CAROLINE GONÇALVES',
                'JULIA GONÇALVES',
            ]),
            'titulo_eleitor' => '101811660272',
            'zona_eleitoral' => '1524784',
            'cnh' => '02737170006',
            'validade_cnh' => Carbon::parse('2020-04-05'),
            'tipo_cnh' => 'C',
            'observacao' => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
