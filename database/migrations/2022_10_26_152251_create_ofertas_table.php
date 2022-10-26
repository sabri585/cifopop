<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            $table->string('texto', 255);
            $table->date('fechaVigencia')->nullable();
            $table->float('importe')->default(0);
            $table->timestamp('fechaAceptacion')->nullable();
            $table->timestamp('fechaRechazo')->nullable();
            $table->unsignedBigInteger('anuncio_id'); //crea el campo para relacionar con la tabla anuncios
            $table->foreign('anuncio_id')->references('id')->on('anuncios'); //relaciona los dos campos
            $table->unsignedBigInteger('user_id'); //crea el campo para relacionar con la tabla users
            $table->foreign('user_id')->references('id')->on('users'); //relaciona los dos campos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ofertas');
    }
}
