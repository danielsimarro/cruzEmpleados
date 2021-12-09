<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajador', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idpuesto')->unsigned();
            $table->bigInteger('iddepartamento')->unsigned();
            $table->string('nombre', 40);
            $table->string('apellido', 80);
            $table->string('email', 80);
            $table->integer('telefono')->unsigned();
            $table->date('fechacontrato')->useCurrent(); //yyy-mm-dd
        
            $table->timestamps();
            $table->foreign('idpuesto')->references('id')->on('puesto');
            $table->foreign('iddepartamento')->references('id')->on('departamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trabajador');
    }
}
