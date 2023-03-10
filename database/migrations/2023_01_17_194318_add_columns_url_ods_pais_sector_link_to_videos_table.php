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
        Schema::table('videos', function (Blueprint $table) {
            $table->unsignedBigInteger('sector_id')->after('foto')->nullable();
            $table->foreign('sector_id')->references('id')->on('sectores');
            $table->string('pais_id')->after('foto')->nullable();
            $table->foreign('pais_id')->references('code')->on('pais');
            $table->string("ods")->after('foto')->nullable();
            $table->string("url")->after('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign(['sector_id']);
            $table->dropForeign(['pais_id']);
            $table->dropColumn('sector_id');
            $table->dropColumn('pais_id');
            $table->dropColumn('ods');
            $table->dropColumn('url');
        });
    }
};
