<?php

namespace App\Http\Controllers;

use App\Http\Requests\DadosPessoaisRequest;
use App\Models\DadosPessoais;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DadosPessoaisController extends Controller
{
    private $dados_pessoais;

    public function __construct(DadosPessoais $dados_pessoais)
    {
        $this->dados_pessoais = $dados_pessoais;
    }

    // -> create
    public function create(DadosPessoaisRequest $request)
    {
        $data = $request->only([
            'nome',
            'rg',
            'cpf',
            'telefone',
            'nome_mae',
            'nome_pai',
            'data_nascimento',
            'municipio_nascimento',
            'sexo',
            'cutis',
            'tipo_sanguineo',
            'estado_civil',
            'profissao',
            'escolaridade',
            'nome_conjuge',
            'nome_filhos',
            'titulo_eleitor',
            'zona_eleitoral',
            'cnh',
            'tipo_cnh',
            'validade_cnh',
            'observacao',
        ]);

        // -> check municipio exists
        $municipio_nascimento_id = Municipio::getMunicipioId(
            'municipio',
            $data['municipio_nascimento']
        );
        if (!$municipio_nascimento_id) {
            return response()->json('Municipio não encontrado', 404);
        }

        dd($municipio_nascimento_id);

        return DadosPessoais::create([('nome')->$data['name']]);
    }
}
