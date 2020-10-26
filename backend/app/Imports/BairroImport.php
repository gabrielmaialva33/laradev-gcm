<?php

namespace App\Imports;

use App\Models\Bairro;

use Maatwebsite\Excel\Concerns\ToModel;

class BairroImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Bairro|null
     */
    public function model(array $row)
    {
        return new Bairro([
            'nome' => $row[1],
            'codigo_bairro' => $row[0],
            'municipio_id' => $row[2],
        ]);
    }
}
