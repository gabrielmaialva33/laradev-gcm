<?php

namespace App\Http\Resources;

use App\Models\DadosPessoais;
use App\Models\Gcm;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string id
 * @property int matricula_gcm
 * @property string nome_guerra
 * @property string atribuicao
 * @property string historico
 * @property boolean status
 */
class GcmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        return $this->resource->toArray();
    }
}
