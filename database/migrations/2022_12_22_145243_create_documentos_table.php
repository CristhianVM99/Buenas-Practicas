<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("ruta");
            $table->string("tipo");
            $table->unsignedBigInteger('proyecto_id')->nullable();
            $table->string("estado");
            $table->timestamps();
            
            $table->foreign('proyecto_id')->references('id')->on('ideas_proyectos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos');
    }
};
