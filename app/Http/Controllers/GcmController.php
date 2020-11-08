<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGcmRequest;
use App\Http\Resources\GcmResource;
use App\Services\bairro\CreateBairroService;
use App\Services\dados_pessoais\CreateDadosPessoaisService;
use App\Services\endereco\CreateEnderecoService;
use App\Services\gcm\CreateGcmService;
use App\Services\gcm\DestroyGcmService;
use App\Services\gcm\IndexGcmService;
use App\Services\gcm\ShowGcmService;
use App\Services\keycode\CreateKeycodeService;

class GcmController extends Controller
{
    // -> index
    public function index()
    {
        $indexGcms = new IndexGcmService();
        $gcms = $indexGcms->execute();

        return new GcmResource($gcms);
    }

    // -> show
    public function show($id)
    {
        $showGcm = new ShowGcmService();
        $gcm = $showGcm->execute($id);

        return new GcmResource($gcm);
    }

    // -> create
    public function create(CreateGcmRequest $request)
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
            'codigo_endereco',
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
            $data['codigo_endereco']
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

        $createKeycode = new CreateKeycodeService();
        $keycode = $createKeycode->execute($gcm_id);

        return response($keycode);
    }

    // -> update
    public function update()
    {
    }

    // -> delete
    public function delete($id)
    {
        $destroyGcm = new DestroyGcmService();
        $destroyGcm->execute($id);

        return response()->json($destroyGcm, 204);
    }
}
