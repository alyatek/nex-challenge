<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AtletasModalidadeAtributo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atletas_modalidade_atributo', function (Blueprint $table) {
            $table->id();
            $table->integer('atleta_id');
            $table->integer('modalidade_atributo_id');
            $table->timestamps();

            $table->index(['atleta_id', 'modalidade_atributo_id'], 'atleta_modalidade_index');
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
