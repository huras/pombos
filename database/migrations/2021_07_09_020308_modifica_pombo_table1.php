<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificaPomboTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pombo', function (Blueprint $table) {
            $table->integer('morto')->default(0)->nullable()->change();
            $table->string('pombal')->nullable()->change();
            $table->integer('macho')->unsigned()->nullable()->change();
            $table->date('nascimento')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pombo', function (Blueprint $table) {
            //
        });
    }
}
