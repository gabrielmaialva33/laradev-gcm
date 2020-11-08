<?php

namespace App\Services\gcm;

use App\Models\Gcm;
use Symfony\Component\HttpKernel\Exception\HttpException;

class IndexGcmService
{
    public function execute()
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

        return $gcms;
    }
}
