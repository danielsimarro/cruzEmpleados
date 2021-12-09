<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagen', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idtrabajador')->unsigned();
            $table->string('nombre', 100);
            $table->string('mimetype', 20);
            $table->string('archivo', 5)->default('no');
            
            $table->foreign('idtrabajador')->references('id')->on('trabajador');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagens');
    }
}
