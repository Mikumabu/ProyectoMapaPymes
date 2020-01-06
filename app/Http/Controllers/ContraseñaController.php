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

        //VALIDAR QUE EL CORREO EXISTA

        $validarCorreo = $request->correo;

        $existeCorreo = DB::select('select name
        from users where email = :correo', ['correo' => $validarCorreo]);

        if($existeCorreo != null){

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

        return back()->with('error1','ERROR: El Correo no Existe');

    }

    public function nuevaContraseña(Request $request){

        $validarCorreo = $request->correo;

        $existeCorreo = DB::select('select name
        from users where email = :correo', ['correo' => $validarCorreo]);

        if($existeCorreo != null){

            if($request->codigo == "xyzUSQAI" | $request->codigo == "asdUSQAI"| $request->codigo == "qweUSQAI"){

                if($request->contraseña == $request->contraseñaConfirmar){

                    $contraseña = \Hash::make($request->contraseña);
                    DB::table('users')->where('email', $request->correo)->update(['password' => $contraseña]);

                    dd("Contraseña Actualizada");

                }

                dd('ERROR: Contraseñas Distintas');

            }

            dd("ERROR: Código Incorrecto");

        }

        dd("ERROR: El Correo no Existe");

    }

}
