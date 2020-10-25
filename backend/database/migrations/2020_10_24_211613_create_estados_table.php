<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            // -> primary generate key uuid
            $table
                ->uuid('id')
                ->unique()
                ->primary()
                ->default(DB::raw('(uuid())'));

            $table->string('codigo_ibge', 2);
            $table->string('uf', 50);
            $table->string('sigla', 2);
            $table->string('gentilico', 100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados');
    }
}
