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
            $gcm = Gcm::getDataGcm($id);
        } catch (HttpException $e) {
            return response()->json(['Erro no servidor'], $e->getStatusCode());
        }

        return $gcm;
    }
}
