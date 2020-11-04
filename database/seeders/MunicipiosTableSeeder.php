<?php

namespace Database\Seeders;

use App\Imports\MunicipioImport;
use App\Models\Estado;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MunicipiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call($this->seedMunicipios('seed_cidades_ac', '12'));
        $this->call($this->seedMunicipios('seed_cidades_al', '27'));
        $this->call($this->seedMunicipios('seed_cidades_am', '13'));
        $this->call($this->seedMunicipios('seed_cidades_ap', '16'));
        $this->call($this->seedMunicipios('seed_cidades_ba', '29'));
        $this->call($this->seedMunicipios('seed_cidades_ce', '23'));
        $this->call($this->seedMunicipios('seed_cidades_df', '53'));
        $this->call($this->seedMunicipios('seed_cidades_es', '32'));
        $this->call($this->seedMunicipios('seed_cidades_go', '52'));
        $this->call($this->seedMunicipios('seed_cidades_ma', '21'));
        $this->call($this->seedMunicipios('seed_cidades_mg', '31'));
        $this->call($this->seedMunicipios('seed_cidades_ms', '50'));
        $this->call($this->seedMunicipios('seed_cidades_mt', '51'));
        $this->call($this->seedMunicipios('seed_cidades_pa', '15'));
        $this->call($this->seedMunicipios('seed_cidades_pb', '25'));
        $this->call($this->seedMunicipios('seed_cidades_pe', '26'));
        $this->call($this->seedMunicipios('seed_cidades_pi', '22'));
        $this->call($this->seedMunicipios('seed_cidades_pr', '41'));
        $this->call($this->seedMunicipios('seed_cidades_rj', '33'));
        $this->call($this->seedMunicipios('seed_cidades_rn', '24'));
        $this->call($this->seedMunicipios('seed_cidades_ro', '11'));
        $this->call($this->seedMunicipios('seed_cidades_rr', '14'));
        $this->call($this->seedMunicipios('seed_cidades_rs', '43'));
        $this->call($this->seedMunicipios('seed_cidades_sc', '42'));
        $this->call($this->seedMunicipios('seed_cidades_se', '28'));
        $this->call($this->seedMunicipios('seed_cidades_sp', '35'));
        $this->call($this->seedMunicipios('seed_cidades_to', '17'));
    }

    public function seedMunicipios(string $file, string $codigo_ibge)
    {
        /**
         * Run the seeds cidades sp.
         *
         * @return void
         */

        $spreadsheet = IOFactory::load("storage/app/xlsx/{$file}.xlsx");
        $sheet = $spreadsheet->getActiveSheet();

        $estado_id = Estado::getEstadoId('codigo_ibge', "{$codigo_ibge}");

        //  dd($sheet->getHighestRow());

        for ($d = 1; $d <= $sheet->getHighestRow(); $d++) {
            try {
                $sheet->getCell("D{$d}")->setValue($estado_id);
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

        Excel::import(new MunicipioImport(), "/xlsx/{$file}.xlsx", 'local');
    }
}
