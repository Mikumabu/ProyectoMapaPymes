<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class AdministradorController extends Controller
{

    public function mostrarDatos(Request $request){

        $formularios = DB::select('select id, nombre_empresa, rut_empresa, categoria, ubicacion, horario, facebook, instagram, formalizado, comuna, contacto, telefono, mail, descripcion  from formularios');
        return view('Administrador/Administrador',compact('formularios', 'request'));

    }

}

