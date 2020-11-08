<?php

namespace Database\Seeders;

use App\Models\Gcm;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // -> Seed user GONÇALVES
        $gcm_id = Gcm::getGcmId('matricula_gcm', '1');

        DB::table('users')->insert([
            'nome_usuario' => 'gonsalves',
            'email' => 'gonsalves@gmail.com',
            'password' => bcrypt('admin'),
            'regra' => 'MASTER',
            'gcm_id' => $gcm_id,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
