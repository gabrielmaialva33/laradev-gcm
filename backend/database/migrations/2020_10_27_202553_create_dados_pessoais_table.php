<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDadosPessoaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_pessoais', function (Blueprint $table) {
            // -> primary generate key uuid
            $table
                ->uuid('id')
                ->unique()
                ->primary()
                ->default(DB::raw('(uuid())'));

            $table->string('nome', 40);
            $table->string('rg', 15)->nullable(true);
            $table->string('cpf', 15)->unique();
            $table->json('telefone')->nullable(true);
            $table->string('nome_mae', 40);
            $table->string('nome_pai', 40)->nullable(true);
            $table->date('data_nascimento');
            $table->uuid('municipio_nascimento_id')->nullable(true);
            $table->enum('sexo', ['MASCULINO', 'FEMININO']);
            $table
                ->enum('cutis', [
                    'BRANCO',
                    'PRETO',
                    'PARDO',
                    'AMARELO',
                    'INDIGENA',
                ])
                ->nullable(true);
            $table
                ->enum('tipo_sanguineo', [
                    'A+',
                    'A-',
                    'B+',
                    'B-',
                    'AB+',
                    'AB-',
                    'O+',
                    'O-',
                ])
                ->nullable(true);
            $table
                ->enum('estado_civil', [
                    'SOLTEIRO',
                    'CASADO',
                    'SEPARADO',
                    'DIVORCIADO',
                    'VIUVO',
                ])
                ->nullable(true);
            $table->string('profissao')->nullable(true);
            $table
                ->enum('escolaridade', [
                    'FUNDAMENTAL-INCOMPLETO',
                    'FUNDAMENTAL-COMPLETO',
                    'MEDIO-INCOMPLETO',
                    'MEDIO-COMPLETO',
                    'SUPERIOR-INCOMPLETO',
                    'SUPERIOR-COMPLETO',
                    'POS-GRADUACAO-INCOMPLETO',
                    'POS-GRADUACAO-COMPLETO',
                    'MESTRADO',
                ])
                ->nullable(true);
            $table->string('nome_conjuge', 20)->nullable(true);
            $table->json('nome_filhos')->nullable(true);
            $table
                ->string('titulo_eleitor', 15)
                ->nullable(true)
                ->unique();
            $table->string('zona_eleitoral', 7)->nullable(true);
            $table
                ->string('cnh', 15)
                ->nullable(true)
                ->unique();
            $table
                ->enum('tipo_cnh', [
                    'ACC',
                    'A',
                    'B',
                    'C',
                    'D',
                    'E',
                    'ACC-B',
                    'ACC-C',
                    'ACC-D',
                    'ACC-E',
                    'A-B',
                    'A-C',
                    'A-D',
                    'A-E',
                ])
                ->nullable(true);
            $table->date('validade_cnh')->nullable(true);
            $table->text('observacao')->nullable(true);

            $table->timestamps();

            // -> foreign municipios
            $table
                ->foreign('municipio_nascimento_id')
                ->references('id')
                ->on('municipios')
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
        Schema::dropIfExists('dados_pessoais');
    }
}
