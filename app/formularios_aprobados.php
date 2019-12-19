<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class formularios_aprobados extends Model
{
    protected $fillable = [
        'nombre_empresa',
        'rut_empresa',
        'categoria',
        'longitud',
        'latitud',
        'ubicacion',
        'horario',
        'facebook',
        'instagram',
        'formalizado',
        'comuna',
        'contacto',
        'telefono',
        'mail',
        'descripcion'
    ];

}
