<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTokenables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokenables', function (Blueprint $table) {
            $table->bigInteger('token_id');
            $table->bigInteger('tokenable_id');
            $table->string('tokenable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tokenables', function (Blueprint $table) {
            $table->drop();
        });
    }
}
