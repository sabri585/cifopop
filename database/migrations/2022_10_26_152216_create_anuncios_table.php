<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnunciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anuncios', function (Blueprint $table) {
            $table->id(); //id autonumérico
            $table->string('titulo', 255);
            $table->string('descripcion', 500);
            $table->float('precio')->default(0);
            $table->string('imagen', 128);
            $table->unsignedBigInteger('user_id'); //crea el campo para relacionar con la tabla users
            $table->foreign('user_id')->references('id')->on('users'); //relaciona los dos campos
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
        Schema::dropIfExists('anuncios');
    }
}
