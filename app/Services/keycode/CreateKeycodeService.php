<?php

namespace App\Services\keycode;

use App\Exceptions\AppError;
use App\Models\Gcm;
use App\Models\Keycode;
use Illuminate\Support\Str;

class CreateKeycodeService
{
    public function execute(string $gcm_id): string
    {
        // -> check exists gcm_id
        $gcmIdExists = Gcm::getGcmId('id', $gcm_id);
        if (!$gcmIdExists) {
            throw new AppError(404, 'Gcm não encontrado');
        }

        $keycode = Str::upper(Str::random(6));

        // -> check keycode exists looping
        for (; ;) {
            $keycodeExists = Keycode::getKeycodeId('keycode', $keycode);
            if (!$keycodeExists) {
                break;
            }
            $keycode = Str::upper(Str::random(6));
        }

        // -> save on database
        return Keycode::create(['keycode' => $keycode, 'gcm_id' => $gcm_id]);
    }
}
