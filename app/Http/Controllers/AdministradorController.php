<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class AdministradorController extends Controller
{

    public function index()
    {
        //
    }

    public function mostrarDatos(Request $request){

        $formularios = DB::select('select id, nombre_empresa, rut_empresa, categoria, ubicacion, horario, facebook, instagram, formalizado, comuna, contacto, telefono, mail, descripcion  from formularios');
        return view('Administrador/Administrador',compact('formularios', 'request'));

    }

    public function rechazar($id){

        DB::table('formularios')->where('id', '=', $id)->delete();

        return back()->with('exito2','Formulario rechazado correctamente');
    }

    public function aceptar($id){

        $formularios = DB::select('select id, nombre_empresa, rut_empresa, categoria, ubicacion, horario, facebook, instagram, formalizado, comuna, contacto, telefono, mail, descripcion  
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
            $key = 'AIzaSyAIuJCrwX-2-hqArtpPyTEn340ezoucpS4';
            $url = urlencode("https://maps.googleapis.com/maps/api/geocode/json?address=".$calle.", ".$comuna."&key=".$key);
            $url = str_replace("%3A", ":", $url);
            $url = str_replace("%2F", "/", $url);
            $url = str_replace("%3F", "?", $url);
            $url = str_replace("%3D", "=", $url);
            $url = str_replace("%2B", "+", $url);
            $url = str_replace("%2C", ",", $url);
            $url = str_replace("%26", "&", $url);
            $json = json_decode(file_get_contents($url), true);
            $latitud = $json['results']['0']['geometry']['location']['lat'];
            $longitud = $json['results']['0']['geometry']['location']['lng'];


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

    public function mostrarDetalles($id){

        $formularios = DB::select('select ubicacion, contacto, telefono, mail, descripcion  
                                    from formularios where id = :id', ['id' => $id]);

        dd($formularios);

    }

    public function editar($id){

        $formularios = DB::select('select id, nombre_empresa, rut_empresa, categoria, ubicacion, horario, facebook, instagram, formalizado, comuna, contacto, telefono, mail, descripcion  
                                    from formularios where id = :id', ['id' => $id]);

        return view('Administrador/AdministradorEditarPendientes',compact('formularios', 'request'));

    }

    public function aprobados(){

        $formularios_aprobados = DB::select('select id, nombre_empresa, rut_empresa, categoria, ubicacion, horario, facebook, instagram, formalizado, comuna, contacto, telefono, mail, descripcion  from formularios_aprobados');
        return view('Administrador/AdministradorAprobados',compact('formularios_aprobados', 'request'));
    }

    public function eliminar($id){

        DB::table('formularios_aprobados')->where('id', '=', $id)->delete();

        return back()->with('exito2','Formulario eliminado correctamente');
    }

    public function editarAprobado($id){

        $formularios_aprobados = DB::select('select id, nombre_empresa, rut_empresa, categoria, ubicacion, horario, facebook, instagram, formalizado, comuna, contacto, telefono, mail, descripcion  
                                    from formularios_aprobados where id = :id', ['id' => $id]);

        return view('Administrador/AdministradorEditarAprobados',compact('formularios_aprobados', 'request'));

    }

    public function mostrarDetallesAprobados($id){

        $formularios_aprobados = DB::select('select ubicacion, contacto, telefono, mail, descripcion  
                                    from formularios_aprobados where id = :id', ['id' => $id]);

        dd($formularios_aprobados);

    }

}

