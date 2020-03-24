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
            $table->unsignedBigInteger('enderecavel_id');
            $table->string('enderecavel_type');
            $table->string('logradouro');
            $table->string('bairro');
            $table->unsignedBigInteger('cep_id');
            $table->timestamps();
            $table->softDeletes();
            //$table->foreign('cep_id')->references('id')->on('ceps');
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
        Schema::dropIfExists('ceps');
    }
}
