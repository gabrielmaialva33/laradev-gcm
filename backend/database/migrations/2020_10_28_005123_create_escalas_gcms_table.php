<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEscalasGcmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escala_gcms', function (Blueprint $table) {
            // -> primary generate key uuid
            $table
                ->uuid('id')
                ->unique()
                ->primary()
                ->default(DB::raw('(uuid())'));

            $table->uuid('gcm_id');
            $table->uuid('escala_id');

            $table->dateTime('data_inicio')->nullable(true);
            $table->dateTime('data_fim')->nullable(true);
            $table->text('observacao')->nullable(true);

            $table->timestamps();

            // -> foreign gcms
            $table
                ->foreign('gcm_id')
                ->references('id')
                ->on('gcms')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // -> foreign escalas
            $table
                ->foreign('escala_id')
                ->references('id')
                ->on('escalas')
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
        Schema::dropIfExists('escala_gcms');
    }
}
