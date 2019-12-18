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

    public function rechazar($id){

        DB::table('formularios')->where('id', '=', $id)->delete();

        return back()->with('exito2','Formulario rechazado correctamente');
    }

    public function aceptar($id){

        $formularios = DB::select('select id, nombre_empresa, rut_empresa, categoria, ubicacion, horario, facebook,
        instagram, formalizado, comuna, contacto, telefono, mail, descripcion, latitud, longitud
        from formularios where id = :id', ['id' => $id]);

        foreach($formularios as $formulario){
            $nombreEmpresa = $formulario->nombre_empresa;
            $rutEmpresa = $formulario->rut_empresa;
            $queOfrece = $formulario->categoria;
            $calle = $formulario->ubicacion;
            $horario = $formulario->horario;
            $facebook = $formulario->facebook;
            $instagram = $formulario->instagram;
            $formalizado = $formulario->formalizado;
            $comuna = $formulario->comuna;
            $contacto = $formulario->contacto;
            $telefono = $formulario->telefono;
            $email = $formulario->mail;
            $descripcion = $formulario->descripcion;
            $latitud = $formulario->latitud;
            $longitud = $formulario->longitud;

            DB::table('formularios_aprobados')->insert([
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

        DB::table('formularios')->where('id', '=', $id)->delete();

        return back()->with('exito3','Formulario ingresado correctamente');

    }

    public function aprobados(){

        $formularios_aprobados = DB::select('select id, nombre_empresa, rut_empresa, categoria, ubicacion, horario, facebook, instagram, formalizado, comuna, contacto, telefono, mail, descripcion  from formularios_aprobados');
        return view('Administrador/AdministradorAprobados',compact('formularios_aprobados', 'request'));
    }

    public function eliminar($id){

        DB::table('formularios_aprobados')->where('id', '=', $id)->delete();

        return back()->with('exito2','Formulario eliminado correctamente');
    }
}

