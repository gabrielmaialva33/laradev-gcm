<?php

namespace App\Http\Controllers;

use App\Http\Requests\GcmRequest;
use App\Services\bairro\CreateBairroService;
use App\Services\dados_pessoais\CreateDadosPessoaisService;
use App\Services\endereco\CreateEnderecoService;
use App\Services\gcm\CreateGcmService;

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

        // -> create bairro gcm
        $createBairro = new CreateBairroService();
        $bairro_id = $createBairro->execute(
            $data['nome_bairro'],
            $data['municipio'],
            $data['codigo_bairro']
        );

        // -> create endereco gcm
        $createEndereco = new CreateEnderecoService();
        $endereco_id = $createEndereco->execute(
            $bairro_id,
            $data['logradouro'],
            $data['numero'],
            $data['complemento'],
            $data['cep'],
            $data['cogigo_endereco']
        );

        // -> create dados pessoais gcm
        $createDadosPessoais = new CreateDadosPessoaisService();
        $dados_pessoais_id = $createDadosPessoais->execute($data);

        // -> create gcm
        $createGcm = new CreateGcmService();
        $gcm_id = $createGcm->execute(
            $data['nome_guerra'],
            $dados_pessoais_id,
            $endereco_id,
            $data['atribuicao']
        );

        return response()->json($gcm_id);
    }
}
