<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ceps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cep');
            $table->string('cidade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('enderecos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descricao');
            $table->string('logradouro');
            $table->string('bairro');
            $table->unsignedBigInteger('cep');
            $table->timestamps();
            $table->softDeletes();
            //$table->foreign('cep_id')->references('id')->on('ceps');
        });
        Schema::create('enderecaveis', function (Blueprint $table) {
            $table->unsignedBigInteger('endereco_id');
            $table->unsignedBigInteger('enderecavel_id');
            $table->string('enderecavel_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('enderecos');
        Schema::drop('ceps');
        Schema::drop('enderecaveis');
    }
}
