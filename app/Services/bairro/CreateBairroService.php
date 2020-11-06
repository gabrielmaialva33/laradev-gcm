<?php

namespace App\Services\bairro;

use App\Exceptions\AppError;
use App\Models\Bairro;
use App\Models\Municipio;

class CreateBairroService
{
    public function execute(
        string $nome,
        ?string $codigo_bairro,
        ?string $observacao,
        string $municipio
    ): string
    {
        // -> check municipio exists and get municipio id
        $municipio_id = Municipio::getMunicipioId('municipio', $municipio);
        if (!$municipio) {
            throw new AppError(404, 'Municipio não encontrado');
        }

        // -> check codigo_bairro with
        if ($codigo_bairro) {
            $bairro_id = Bairro::getBairroId('codigo_bairro', $codigo_bairro);
            if (!$bairro_id) {
                throw new AppError(404, 'Código do bairro não encontrado');
            }
            return $bairro_id;
        }

        // -> save on database
        return Bairro::create([
            'nome' => $nome,
            'observacao' => $observacao,
            'municipio_id' => $municipio_id,
        ])->id;
    }
}
