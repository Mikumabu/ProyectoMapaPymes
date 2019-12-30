<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nombre_empresa');
            $table->string('rut_empresa')->nullable();
            $table->string('categoria');
            $table->string('longitud');
            $table->string('latitud');
            $table->string('ubicacion');
            $table->string('horario');
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('url')->nullable();
            $table->string('formalizado');
            $table->string('comuna');
            $table->string('contacto');
            $table->string('telefono');
            $table->string('mail');
            $table->string('descripcion');
            $table->string('icono');
            $table->string('imagen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formularios');
    }
}
