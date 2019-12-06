<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FormulariosAprobados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios_aprobados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nombre_empresa');
            $table->string('rut_empresa');
            $table->string('categoria');
            $table->string('longitud');
            $table->string('latitud');
            $table->string('ubicacion');
            $table->string('horario');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('formalizado');
            $table->string('comuna');
            $table->string('contacto');
            $table->string('telefono');
            $table->string('mail');
            $table->string('descripcion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formularios_aprobados');
    }
}
