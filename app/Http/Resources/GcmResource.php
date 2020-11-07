<?php

namespace App\Http\Resources;

use App\Models\DadosPessoais;
use App\Models\Gcm;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GcmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
