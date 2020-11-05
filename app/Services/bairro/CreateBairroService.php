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
    )
    {
        // -> check municipio exists and get municipio id
        $municipio_id = Municipio::getMunicipioId('municipio', $municipio);
        if (!$municipio) {
            throw new AppError(404, 'Municipio não encontrado');
        }

        // -> save on database
        return Bairro::create([
            'nome' => $nome,
            'codigo_bairro' => $codigo_bairro,
            'observacao' => $observacao,
            'municipio_id' => $municipio_id,
        ])->id;
    }
}
