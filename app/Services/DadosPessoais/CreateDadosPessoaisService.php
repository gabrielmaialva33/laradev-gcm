<?php

namespace App\Services\DadosPessoais;

use App\Exceptions\AppError;
use App\Models\DadosPessoais;
use App\Models\Municipio;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CreateDadosPessoaisService
{
    public function execute($data)
    {
        // -> check cpf exists
        $cpf_exists = DadosPessoais::getDadosPessoaisId('cpf', $data['cpf']);
        if ($cpf_exists) {
            throw new AppError(409, 'CPF já cadastrado');
        }

        // -> check municipio exists
        $municipio_nascimento_id = Municipio::getMunicipioId(
            'municipio',
            $data['municipio_nascimento']
        );
        if (!$municipio_nascimento_id) {
            throw new HttpException(404, 'Municipio não encontrado');
        }

        // -> save on database
        return DadosPessoais::create([
            'nome' => $data['nome'],
            'rg' => $data['rg'],
            'cpf' => $data['cpf'],
            'telefone' => $data['telefone'],
            'nome_mae' => $data['nome_mae'],
            'nome_pai' => $data['nome_pai'],
            'data_nascimento' => $data['data_nascimento'],
            'municipio_nascimento_id' => $municipio_nascimento_id,
            'sexo' => $data['sexo'],
            'cutis' => $data['cutis'],
            'tipo_sanguineo' => $data['tipo_sanguineo'],
            'estado_civil' => $data['estado_civil'],
            'profissao' => $data['profissao'],
            'escolaridade' => $data['escolaridade'],
            'nome_conjuge' => $data['nome_conjuge'],
            'nome_filhos' => $data['nome_filhos'],
            'titulo_eleitor' => $data['titulo_eleitor'],
            'zona_eleitoral' => $data['zona_eleitoral'],
            'cnh' => $data['cnh'],
            'tipo_cnh' => $data['tipo_cnh'],
            'validade_cnh' => $data['validade_cnh'],
            'observacao' => $data['observacao'],
        ])->id;
    }
}
