<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePomboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pombo', function (Blueprint $table) {
            $table->id();
            $table->string('anilha')->unique();
            $table->string('nome')->nullable();
            $table->date('nascimento')->nullable();
            $table->unsignedTinyInteger('macho');
            $table->string('foto')->nullable();
            $table->text('obs')->nullable();
            $table->string('cor')->nullable();            
            $table->unsignedBigInteger('pai_id')->nullable();            
            $table->unsignedBigInteger('mae_id')->nullable();            
            $table->unsignedBigInteger('pombal_id');
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
        Schema::dropIfExists('pombo');
    }
}
