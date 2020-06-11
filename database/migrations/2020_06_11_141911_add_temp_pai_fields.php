<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTempPaiFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pombo', function (Blueprint $table) {
            $table->string('temp_pai')->nullable()->default(null)->comment('Armazena informações para ser usada na hora de deduzir que um pombo que esta sendo cadastrado é pai de outro que ja foi cadastrado.');
            $table->string('temp_mae')->nullable()->default(null)->comment('Armazena informações para ser usada na hora de deduzir que um pombo que esta sendo cadastrado é mãe de outro que ja foi cadastrado.');
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
            $table->dropColumn('temp_pai');
            $table->dropColumn('temp_mae');
        });
    }
}
