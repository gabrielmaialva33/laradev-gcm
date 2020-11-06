<?php

namespace App\Services\endereco;

use App\Exceptions\AppError;
use App\Models\Bairro;
use App\Models\Endereco;

class CreateEnderecoService
{
    function execute(
        string $logradouro,
        ?string $numero,
        ?string $complemento,
        ?string $cep,
        ?string $codigo_endereco,
        string $bairro_id
    ): string
    {
        // -> check bairro_id
        $bairroExists = Bairro::getBairroId('id', $bairro_id);
        if (!$bairroExists) {
            throw new AppError(404, 'Bairro não encontrado');
        }

        // -> check codigo_endereco
        if ($codigo_endereco) {
            $endereco_id = Endereco::getEnderecoId(
                'codigo_endereco',
                $codigo_endereco
            );
            if (!$endereco_id) {
                throw new AppError(404, 'Código do endereço não encontrado');
            }
            return $endereco_id;
        }

        // -> save on database
        return Bairro::create([
            'logradouro' => $logradouro,
            'numero' => $numero,
            'complemento' => $complemento,
            'cep' => $cep,
            'bairro_id' => $bairro_id,
        ]);
    }
}
