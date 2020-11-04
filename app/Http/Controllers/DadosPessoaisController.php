<?php

namespace App\Http\Controllers;

use App\Http\Requests\DadosPessoaisRequest;
use App\Models\DadosPessoais;
use App\Models\Municipio;
use App\Services\DadosPessoais\CreateDadosPessoaisService;

class DadosPessoaisController extends Controller
{
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

        $create_dados_pessoais = new CreateDadosPessoaisService();
        $dados_pessoais = $create_dados_pessoais->execute($data);

        return response()->json($dados_pessoais);
    }
}
