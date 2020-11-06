<?php

namespace App\Services\gcm;

use App\Exceptions\AppError;
use App\Models\DadosPessoais;
use App\Models\Endereco;
use App\Models\Gcm;

class CreateGcmService
{
    public function execute(
        string $nome_guerra,
        string $dados_pessoais_id,
        string $endereco_id,
        string $atribuicao
    ): string
    {
        // -> check dados pessoais exists
        $dadosPessaoisExists = DadosPessoais::getDadosPessoaisId(
            'id',
            $dados_pessoais_id
        );
        if (!$dadosPessaoisExists) {
            throw new AppError(404, 'Dados Pessoais não encontrado');
        }

        // -> check endereco exists
        $enderecoExists = Endereco::getEnderecoId('id', $endereco_id);
        if (!$enderecoExists) {
            throw new AppError(404, 'Endereço não encontrado');
        }

        // -> save on database

        /** @var string $gcm_id */
        $gcm_id = Gcm::create([
            "nome_guerra" => $nome_guerra,
            "dados_pessoais_id" => $dados_pessoais_id,
            "endereco_id" => $endereco_id,
            "atribuicao" => $atribuicao,
        ])->id;

        return $gcm_id;
    }
}
