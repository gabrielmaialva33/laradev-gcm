<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateKeycodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keycodes', function (Blueprint $table) {
            // -> primary generate key uuid
            $table
                ->uuid('id')
                ->unique()
                ->primary()
                ->default(DB::raw('(uuid())'));

            $table->string('keycode')->unique();
            $table->uuid('gcm_id');
            $table->boolean('active')->default(true);

            $table->timestamps();

            // -> foreign gcms
            $table
                ->foreign('gcm_id')
                ->references('id')
                ->on('gcms')
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
        Schema::dropIfExists('keycodes');
    }
}
