<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descricao')->nullable();
            $table->string('numero')->unique();
            $table->boolean('principal')->default(false);
            $table->boolean('whatsapp')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('telefonaveis', function (Blueprint $table) {
            $table->unsignedBigInteger('telefone_id');
            $table->unsignedBigInteger('telefonavel_id');
            $table->string('telefonavel_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('telefones');
        Schema::drop('telefonaveis');
    }
}
