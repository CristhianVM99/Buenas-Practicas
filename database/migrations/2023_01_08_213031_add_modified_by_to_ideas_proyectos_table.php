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
        Schema::table('ideas_proyectos', function (Blueprint $table) {
            $table->unsignedBigInteger('modified_by')->after('created_by')->nullable();
            $table->foreign('modified_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ideas_proyectos', function (Blueprint $table) {
            $table->dropForeign(['modified_by']);
            $table->dropColumn('modified_by');
        });
    }
};
