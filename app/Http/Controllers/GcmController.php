<?php

namespace App\Http\Controllers;

use App\Http\Requests\GcmRequest;
use App\Services\endereco\CreateEnderecoService;

class GcmController extends Controller
{
    public function create(GcmRequest $request)
    {
        $data = $request->only([
            // -> dados pessoais
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
            // -> bairro
            'nome_bairro',
            'codigo_bairro',
            'bairro_observacao',
            'municipio',
            // -> endereco
            'logradouro',
            'numero',
            'complemento',
            'cogigo_endereco',
            'cep',
            // -> gcm
            'nome_guerra',
            'atribuicao',
        ]);

        //todo CreateDadosPessaoisService

        //todo CreateBairroService

        //todo CreateGcmService

        //todo CreateGcmService

        //todo CreateKeyCodeService

        dd($data);
        return response()->json();
    }
}
