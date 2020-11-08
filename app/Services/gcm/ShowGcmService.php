<?php


namespace App\Services\gcm;


use App\Exceptions\AppError;
use App\Models\Gcm;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ShowGcmService
{
    public function execute(string $id)
    {
        // -> check id is uuid
        if (!Str::isUuid($id) || !Gcm::getGcmId('id', $id)) {
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

        return $gcm;
    }
}
