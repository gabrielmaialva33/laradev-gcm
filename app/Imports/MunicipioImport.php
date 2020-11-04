<?php

namespace App\Imports;

use App\Models\Municipio;
use Maatwebsite\Excel\Concerns\ToModel;

class MunicipioImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Municipio
     */
    public function model(array $row)
    {
        return new Municipio([
            'codigo_ibge' => $row[0],
            'municipio' => $row[1],
            'gentilico' => $row[2],
            'estado_id' => $row[3],
        ]);
    }
}
