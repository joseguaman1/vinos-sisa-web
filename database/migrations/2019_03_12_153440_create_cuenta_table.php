<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuenta', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('email', 100)->unique();
            $table->string('clave', 100);
            $table->string('token', 100);
            $table->boolean('estado')->default(true);
            $table->timestamps();
            $table->integer('id_persona');
            $table->index('id_persona');
            $table->foreign('id_persona')->references('id')->on('persona');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuenta');
    }
}
