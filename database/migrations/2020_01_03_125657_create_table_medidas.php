<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMedidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medidas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('abreviacao');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('produtos', function (Blueprint $table) {
            $table->unsignedBigInteger('medida_id')->nullable();
            $table->foreign('medida_id')
                ->references('id')
                ->on('medidas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign(['medida_id']);
            $table->dropColumn('medida_id');
        });
        Schema::dropIfExists('medidas');
    }
}
