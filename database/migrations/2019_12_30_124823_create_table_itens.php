<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableItens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('produto_id');
            $table->unsignedBigInteger('lista_id');
            $table->string('lista_type');
            $table->float('preco_normal')->default(0.0);
            $table->float('preco_promocao')->default(0.0);
            $table->float('quantidade')->default(0.0);
            $table->string('observacao')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('itens');
    }
}
