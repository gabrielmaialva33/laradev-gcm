<?php

namespace App\Imports;


use App\Models\Estado;
use Maatwebsite\Excel\Concerns\ToModel;

class EstadosImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Estado
     */
    public function model(array $row)
    {
        return new Estado([
            'codigo_ibge' => $row[0],
            'uf' => $row[1],
            'sigla' => $row[2],
            'gentilico' => $row[3],
        ]);
    }
}
