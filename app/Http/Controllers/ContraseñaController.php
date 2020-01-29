<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;

class ContraseñaController extends Controller
{

    /* Método que redirecciona a la Vista de Recuperar Contraseña */

    public function menuRecuperar(){

        return view('Contraseña/MenuContraseña');

    }

    /* Método que genera un Código Verificador, este código es guardado en la tabla "codigo_verificador" con el
       correspondiente correo electrónico que solicita el cambio de contraseña */

    public function generarCodigo(Request $request){


        $validarCorreo = $request->correo;

        $existeCorreo = DB::select('select name
        from users where email = :correo', ['correo' => $validarCorreo]);

        if($existeCorreo != null){


            $length = 10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }


            $to_name = 'JC';
            $to_email = $request->correo;
            $data = array('name'=>"Código Verificador",
                "body" => "Su Código es ".$randomString);

            \Mail::send('Email\send_email', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject('Cambiar Contraseña');
                $message->from('jmr025@alumnos.ucn.cl','Administrador #VitrineaEmprendedores');
            });


            DB::table('codigo_verificador')->insert([
                'codigo' => $randomString,
                'correo' => $to_email
            ]);

            return view('Contraseña/CambiarContraseña');

        }

        return back()->with('error1','ERROR: El Correo no Existe');

    }

    /* Método que recibe como parámetros los datos para cambiar la Contraseña, se comprueba que esté correctamente
       ingresado y luego se modifica la contraseña de la tabla "users". El Código Verificador es eliminado */

    public function nuevaContraseña(Request $request){


        $codigoVerificador = DB::select('select codigo
        from codigo_verificador where codigo = :codigo', ['codigo' => $request->codigo]);

        if($codigoVerificador != null){

            if($request->contraseña == $request->contraseñaConfirmar){

                $correo = DB::select('select correo
                from codigo_verificador where codigo = :codigo', ['codigo' => $request->codigo]);

                $contraseña = \Hash::make($request->contraseña);
                DB::table('users')->where('email', $correo[0]->correo)->update(['password' => $contraseña]);

                DB::table('codigo_verificador')->where('correo', '=', $request->correo)->delete();

                return back()->with('exito1','Contraseña Actualizada');

            }

            return back()->with('error3','ERROR: Confirme bien la Contraseña');

        }

        return back()->with('error2','ERROR: Código Incorrecto');


    }

}
