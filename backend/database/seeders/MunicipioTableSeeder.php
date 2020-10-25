<?php

namespace Database\Seeders;

use App\Imports\MunicipioImport;
use App\Models\Estado;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MunicipioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call($this->seedCidadesSP());
    }

    public function seedCidadesSP()
    {
        /**
         * Run the seeds cidades sp.
         *
         * @return void
         */

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(
            'storage/app/xlsx/seed_cidades_sp.xlsx'
        );

        $sheet = $spreadsheet->getActiveSheet();

        $estado_id = Estado::getEstadoId('codigo_ibge', '35');

        for ($d = 1; $d <= 645; $d++) {
            try {
                $sheet->getCell("D{$d}")->setValue($estado_id);
            } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
                dd($e);
            }
        }

        $writer = new Xlsx($spreadsheet);

        try {
            $writer->save('storage/app/xlsx/seed_cidades_sp.xlsx');
        } catch (Exception $e) {
            dd($d);
        }

        Excel::import(
            new MunicipioImport(),
            '/xlsx/seed_cidades_sp.xlsx',
            'local'
        );
    }
}
