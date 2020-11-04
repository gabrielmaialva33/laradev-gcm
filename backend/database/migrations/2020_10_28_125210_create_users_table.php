<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // -> primary generate key uuid
            $table
                ->uuid('id')
                ->unique()
                ->primary()
                ->default(DB::raw('(uuid())'));

            $table->string('nome_usuario', 15)->unique();
            $table->string('email', 30)->unique();
            $table->string('password');
            $table->enum('regra', ['ADMIN', 'MASTER', 'MEMBRO']);
            $table->string('avatar')->nullable(true);
            $table->uuid('gcm_id');

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
        Schema::dropIfExists('users');
    }
}
