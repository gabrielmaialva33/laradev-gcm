<?php

namespace Database\Seeders;

use App\Imports\BairroImport;
use App\Models\Municipio;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BairrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call($this->seedBairros('seed_bairros_itarare', '3523206'));
    }

    public function seedBairros(string $file, string $codigo_ibge)
    {
        $spreadsheet = IOFactory::load("storage/app/xlsx/{$file}.xlsx");
        $sheet = $spreadsheet->getActiveSheet();

        $municipio_id = Municipio::getMunicipioId(
            'codigo_ibge',
            "{$codigo_ibge}"
        );

        for ($d = 1; $d <= $sheet->getHighestRow(); $d++) {
            try {
                $sheet->getCell("C{$d}")->setValue($municipio_id);
            } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
                dd($e);
            }
        }

        $writer = new Xlsx($spreadsheet);

        try {
            $writer->save("storage/app/xlsx/{$file}.xlsx");
        } catch (Exception $e) {
            dd($d);
        }

        Excel::import(new BairroImport(), "/xlsx/{$file}.xlsx", 'local');
    }
}
