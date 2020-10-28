<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGcmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('gcms', function (Blueprint $table) {
            // -> primary generate key uuid
            $table
                ->uuid('id')
                ->unique()
                ->primary()
                ->default(DB::raw('(uuid())'));

            $table->string('nome_guerra');

            $table->uuid('dados_pessoais_id');
            $table->uuid('endereco_id');
            $table
                ->enum('atribuicao', [
                    'COMANDANTE',
                    'SUB_COMANDANTE',
                    'ADMINISTRATIVO',
                    'COI',
                    'SUPERVISOR',
                    'OFICIAL',
                ])
                ->default('OFICIAL');
            $table->text('historico')->nullable(true);
            $table->boolean('status')->default(true);

            $table->timestamps();

            // -> foreign dados_pessoais
            $table
                ->foreign('dados_pessoais_id')
                ->references('id')
                ->on('dados_pessoais')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // -> foreign enderecos
            $table
                ->foreign('endereco_id')
                ->references('id')
                ->on('enderecos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // - create matricula_gcm
        DB::statement(
            'ALTER Table gcms add matricula_gcm INTEGER NOT NULL UNIQUE AUTO_INCREMENT AFTER `id`;'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gcms');
    }
}
