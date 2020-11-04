<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            // -> primary generate key uuid
            $table
                ->uuid('id')
                ->unique()
                ->primary()
                ->default(DB::raw('(uuid())'));

            $table->string('logradouro', 200);
            $table->string('numero', 4)->nullable(true);
            $table->string('complemento', 100)->nullable(true);
            $table->string('cep')->nullable(true);
            $table->string('codigo_endereco', 6)->nullable(true);
            $table->uuid('bairro_id');

            $table->timestamps();

            // -> foreign municipios
            $table
                ->foreign('bairro_id')
                ->references('id')
                ->on('bairros')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
}
