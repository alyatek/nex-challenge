<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModalidalidadeAtributos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modalidade_atributos', function (Blueprint $table) {
            $table->id();
            $table->string('modalidade_id');
            $table->string('atributo_id');
            $table->timestamps();

            $table->index(['modalidade_id', 'atributo_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
