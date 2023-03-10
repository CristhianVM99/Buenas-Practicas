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
        Schema::create('ideas_proyectos', function (Blueprint $table) {
            $table->id();
            $table->boolean('tipo')->default(false);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('sector')->nullable();
            $table->string('pais', 50)->nullable();
            $table->string("ciudad");
            $table->string("titulo");
            $table->text('descripcion')->nullable();
            $table->string("poblacion");
            $table->string("entidad")->nullable();
            $table->decimal('presupuesto', 10, 2);
            $table->string("ods")->nullable();
            $table->boolean('aprobacion')->default(false);
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('pais')->references('code')->on('pais');
            $table->foreign('sector')->references('id')->on('sectores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ideas_proyectos');
    }
};
