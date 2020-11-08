<?php

namespace App\Http\Controllers;

use App\Exceptions\AppError;
use App\Http\Requests\CreateGcmRequest;
use App\Http\Resources\GcmResource;
use App\Models\Gcm;
use App\Services\bairro\CreateBairroService;
use App\Services\dados_pessoais\CreateDadosPessoaisService;
use App\Services\endereco\CreateEnderecoService;
use App\Services\gcm\CreateGcmService;
use App\Services\keycode\CreateKeycodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GcmController extends Controller
{
    // -> index
    public function index()
    {
        try {
            $gcms = Gcm::with([
                'dados_pessoais',
                'endereco',
                'endereco.bairro',
                'endereco.bairro.municipio',
                'endereco.bairro.municipio.estado',
                'dados_pessoais.municipio_nascimento',
                'dados_pessoais.municipio_nascimento.estado',
            ])->get();
        } catch (HttpException $e) {
            return response()->json(['Erro no servidor'], $e->getStatusCode());
        }

        return new GcmResource($gcms);
    }

    // -> show
    public function show($id)
    {
        // -> check id is uuid
        if (!Str::isUuid($id)) {
            throw new AppError(400, 'Parâmetro invalido');
        }

        try {
            $gcm = Gcm::with([
                'dados_pessoais',
                'endereco',
                'endereco.bairro',
                'endereco.bairro.municipio',
                'endereco.bairro.municipio.estado',
                'dados_pessoais.municipio_nascimento',
                'dados_pessoais.municipio_nascimento.estado',
            ])->find($id);
        } catch (HttpException $e) {
            return response()->json(['Erro no servidor'], $e->getStatusCode());
        }

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
        // -> check id is uuid
        if (!Str::isUuid($id)) {
            throw new AppError(400, 'Parâmetro invalido');
        }

        try {
            $gcm_id = Gcm::find($id)->id;
        } catch (HttpException $e) {
            return response()->json(['Erro no servidor'], $e->getStatusCode());
        }

        Gcm::destroy($gcm_id);

        return response()->json(['GCM deletado com sucesso'], 204);
    }
}
