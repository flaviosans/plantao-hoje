<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCampanhas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanhas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('loja_id');
            $table->string('titulo');
            $table->string('descricao')->nullable();
            $table->timestamp('validade');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('loja_id')->references('id')->on('lojas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campanhas', function (Blueprint $table) {
            $table->drop();
        });
    }
}
