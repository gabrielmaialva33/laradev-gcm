<?php

namespace App\Services\gcm;

use App\Exceptions\AppError;
use App\Models\DadosPessoais;
use App\Models\Endereco;
use App\Models\Gcm;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DestroyGcmService
{
    public function execute(string $id)
    {
        // -> check id is uuid
        if (!Str::isUuid($id) || !Gcm::getGcmId('id', $id)) {
            throw new AppError(400, 'Parâmetro invalido');
        }

        $endereco_id = Gcm::where('id', $id)->first()->endereco_id;
        $dados_pessoais_id = Gcm::where('id', $id)->first()->dados_pessoais_id;

        try {
            Endereco::where('id', $endereco_id)->delete();
            DadosPessoais::where('id', $dados_pessoais_id)->delete();
        } catch (HttpException $e) {
            return response()->json(['Erro no servidor'], $e->getStatusCode());
        }

        return true;
    }
}
