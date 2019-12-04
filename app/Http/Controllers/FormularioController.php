<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class FormularioController extends Controller
{

    public function ingresar(Request $request){

        $nombreEmpresa = request()->nombreEmpresa;
        $rutEmpresa = request()->rutEmpresa;
        $queOfrece = request()->queOfrece;
        $longitud = request()->longitud;
        $latitud = request()->latitud;
        $calle = request()->calle;
        $horario = request()->horario;
        $facebook = request()->facebook;
        $instagram = request()->instagram;
        $formalizado = request()->formalizado;
        $comuna = request()->comuna;
        $contacto = request()->contacto;
        $telefono = request()->telefono;
        $email = request()->email;
        $descripcion = request()->descripcion;


        DB::table('formularios')->insert([
            'nombre_empresa' => $nombreEmpresa,
            'rut_empresa' => $rutEmpresa,
            'categoria' => $queOfrece,
            'longitud' => $longitud,
            'latitud' => $latitud,
            'ubicacion' => $calle,
            'horario' => $horario,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'formalizado' => $formalizado,
            'comuna' => $comuna,
            'contacto' => $contacto,
            'telefono' => $telefono,
            'mail' => $email,
            'descripcion' => $descripcion

        ]);


    }
}
