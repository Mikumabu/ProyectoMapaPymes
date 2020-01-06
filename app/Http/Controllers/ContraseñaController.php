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
                    "body" => "Su Código es as125de2sUSQAI");

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
                    "body" => "Su Código es as4s1e796dUSQAI");

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
                    "body" => "Su Código es qw1e54np74aeUSQAI");

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
                    "body" => "Su Código es 2asd4jk96lUSQAI");

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
                    "body" => "Su Código es b79n54fk2mUSQAI");

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

            if($request->codigo == "as125de2sUSQAI" | $request->codigo == "as4s1e796dUSQAI"| $request->codigo == "qw1e54np74aeUSQAI"| $request->codigo == "2asd4jk96lUSQAI"| $request->codigo == "b79n54fk2mUSQAI"){

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
