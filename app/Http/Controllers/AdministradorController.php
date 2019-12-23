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

        $formularios = DB::select('select mail from formularios where id = :id', ['id' => $id]);

        foreach($formularios as $formulario){

            $email = $formulario->mail;
            $to_name = 'JC';
            $to_email = $email;
            $data = array('name'=>"Lamentamos informar que su solicitud a Mapas PYMES ha sido rechazada",
                "body" => "Estimado, junto con saludar, le informamos que su Empresa no cumple con los requisitos
                           para ser figurar en el Mapa.
                           Saludos cordiales.");

            \Mail::send('Email\send_email', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject('Solicitud Rechazada');
                $message->from('jmr025@alumnos.ucn.cl','Administrador Mapa PYMES');
            });

        }

        DB::table('formularios')->where('id', '=', $id)->delete();
        return back()->with('exito2','Formulario rechazado correctamente');
    }

    public function aceptar($id){

        $formularios = DB::select('select id, nombre_empresa, rut_empresa, categoria, ubicacion, horario, facebook,
        instagram, url, formalizado, comuna, contacto, telefono, mail, descripcion, latitud, longitud, imagen
        from formularios where id = :id', ['id' => $id]);

        foreach($formularios as $formulario){
            $nombreEmpresa = $formulario->nombre_empresa;
            $rutEmpresa = $formulario->rut_empresa;
            $queOfrece = $formulario->categoria;
            $calle = $formulario->ubicacion;
            $horario = $formulario->horario;
            $facebook = $formulario->facebook;
            $instagram = $formulario->instagram;
            $url = $formulario->url;
            $formalizado = $formulario->formalizado;
            $comuna = $formulario->comuna;
            $contacto = $formulario->contacto;
            $telefono = $formulario->telefono;
            $email = $formulario->mail;
            $descripcion = $formulario->descripcion;
            $latitud = $formulario->latitud;
            $longitud = $formulario->longitud;
            $rutaImagen = $formulario->imagen;

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
                'url' => $url,
                'formalizado' => $formalizado,
                'comuna' => $comuna,
                'contacto' => $contacto,
                'telefono' => $telefono,
                'mail' => $email,
                'descripcion' => $descripcion,
                'imagen' => $rutaImagen
            ]);

            $to_name = 'JC';
            $to_email = $email;
            $data = array('name'=>"¡Felicitaciones! Su Solicitud de ingresar a Mapa PYMES ha sido aceptada",
                "body" => "Estimado, 
                           le informamos que su solicitud ha sido aceptada, ahora podrá visualizar su Empresa
                           en http://proyectomapapymes.test/ con todos los datos ingresados.
                           Saludos cordiales.");

            \Mail::send('Email\send_email', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject('Solicitud Aceptada');
                $message->from('jmr025@alumnos.ucn.cl','Administrador Mapa PYMES');
            });

        }

        DB::table('formularios')->where('id', '=', $id)->delete();

        return back()->with('exito3','Formulario ingresado correctamente');

    }

    public function aprobados(){

        $formularios_aprobados = DB::select('select id, nombre_empresa, rut_empresa, categoria, ubicacion, horario, facebook, instagram, url, formalizado, comuna, contacto, telefono, mail, descripcion  from formularios_aprobados');
        return view('Administrador/AdministradorAprobados',compact('formularios_aprobados', 'request'));
    }

    public function eliminar($id){

        DB::table('formularios_aprobados')->where('id', '=', $id)->delete();

        return back()->with('exito2','Formulario eliminado correctamente');
    }
}

