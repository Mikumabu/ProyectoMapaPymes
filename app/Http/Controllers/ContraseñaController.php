<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;

class ContraseñaController extends Controller
{

    public function menuRecuperar(){

        return view('Contraseña/MenuContraseña');

    }

    public function generarCodigo(Request $request){


        $validarCorreo = $request->correo;

        $existeCorreo = DB::select('select name
        from users where email = :correo', ['correo' => $validarCorreo]);

        if($existeCorreo != null){

            $numero = rand(1,5);

            if($numero == 1){
                $to_name = 'JC';
                $to_email = $request->correo;
                $data = array('name'=>"Código Verificador",
                    "body" => "Su Código es xyzUSQAI");

                \Mail::send('Email\send_email', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                        ->subject('Cambiar Contraseña');
                    $message->from('jmr025@alumnos.ucn.cl','Administrador Mapa PYMES');
                });
                return view('Contraseña/CambiarContraseña');
            }
            if($numero == 2){
                $to_name = 'JC';
                $to_email = $request->correo;
                $data = array('name'=>"Código Verificador",
                    "body" => "Su Código es asdUSQAI");

                \Mail::send('Email\send_email', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                        ->subject('Cambiar Contraseña');
                    $message->from('jmr025@alumnos.ucn.cl','Administrador Mapa PYMES');
                });
                return view('Contraseña/CambiarContraseña');
            }
            if($numero == 3){
                $to_name = 'JC';
                $to_email = $request->correo;
                $data = array('name'=>"Código Verificador",
                    "body" => "Su Código es qweUSQAI");

                \Mail::send('Email\send_email', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                        ->subject('Cambiar Contraseña');
                    $message->from('jmr025@alumnos.ucn.cl','Administrador Mapa PYMES');
                });
                return view('Contraseña/CambiarContraseña');
            }
            if($numero == 4){
                $to_name = 'JC';
                $to_email = $request->correo;
                $data = array('name'=>"Código Verificador",
                    "body" => "Su Código es jklUSQAI");

                \Mail::send('Email\send_email', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                        ->subject('Cambiar Contraseña');
                    $message->from('jmr025@alumnos.ucn.cl','Administrador Mapa PYMES');
                });
                return view('Contraseña/CambiarContraseña');
            }
            if($numero == 5){
                $to_name = 'JC';
                $to_email = $request->correo;
                $data = array('name'=>"Código Verificador",
                    "body" => "Su Código es bnmUSQAI");

                \Mail::send('Email\send_email', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                        ->subject('Cambiar Contraseña');
                    $message->from('jmr025@alumnos.ucn.cl','Administrador Mapa PYMES');
                });
                return view('Contraseña/CambiarContraseña');
            }

        }

        return back()->with('error1','ERROR: El Correo no Existe');

    }

    public function nuevaContraseña(Request $request){

        $validarCorreo = $request->correo;

        $existeCorreo = DB::select('select name
        from users where email = :correo', ['correo' => $validarCorreo]);

        if($existeCorreo != null){

            if($request->codigo == "xyzUSQAI" | $request->codigo == "asdUSQAI"| $request->codigo == "qweUSQAI"| $request->codigo == "jklUSQAI"| $request->codigo == "bnmUSQAI"){

                if($request->contraseña == $request->contraseñaConfirmar){

                    $contraseña = \Hash::make($request->contraseña);
                    DB::table('users')->where('email', $request->correo)->update(['password' => $contraseña]);

                    return back()->with('exito1','Contraseña Actualizada');

                }

                return back()->with('error3','ERROR: Confirme bien la Contraseña');

            }

            return back()->with('error2','ERROR: Código Incorrecto');

        }

        return back()->with('error1','ERROR: El Correo no Existe');

    }

}
