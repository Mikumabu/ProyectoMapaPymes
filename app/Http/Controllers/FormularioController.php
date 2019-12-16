<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\formulario;
use Illuminate\Support\Str;

use DB;
use PhpParser\Node\Expr\Cast\Object_;

class FormularioController extends Controller
{

    public function ingresar(Request $request){

        $reglas = [
            'nombreEmpresa' => 'required',
            'rutEmpresa' => 'required',
            'queOfrece' => 'required',
            'calle' => 'required',
            'horario' => 'required',
            'facebook' => 'url|nullable',
            'instagram' => 'url|nullable',
            'comuna' => 'required',
            'contacto' => 'required',
            'telefono' => 'required',
            'email' => 'required|email',
            'descripcion' => 'required|max:500'
        ];
        $mensajes=[
            'nombreEmpresa.required' => 'El nombre de la empresa es obligatorio.',
            'rutEmpresa.required' => 'El rut de la empresa es obligatorio.',
            'queOfrece.required' => 'La categoría de la empresa es obligatoria.',
            'calle.required' => 'Se necesita una dirección.',
            'horario.required' => 'Es importante saber las horas que atiende.',
            'facebook.url' => 'Debe ser una dirección de facebook.',
            'instagram.url' => 'Debe ser una dirección de instagram.',
            'comuna.required' => 'Indique la comuna que se encuentra la empresa.',
            'contacto.required' => 'Indique el nombre del representante de la empresa.',
            'telefono.required' => 'El telefono de la empresa es importante para comunicarse con usted.',
            'email.required' => 'El correo electronico es importante para comunicarse con usted.',
            'email.email' => 'Debe ser un correo electronico.',
            'descripcion.required' => 'Debe incluir una descripción de la empresa.',
            'descripcion.max' => 'La descripción debe ser de unos 500 carácteres.',
        ];

        $this->validate($request, $reglas, $mensajes);

        $nombreEmpresa = request()->nombreEmpresa;
        $rutEmpresa = request()->rutEmpresa;
        $queOfrece = request()->queOfrece;
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

        $key = 'AIzaSyAIuJCrwX-2-hqArtpPyTEn340ezoucpS4';
        $url = urlencode("https://maps.googleapis.com/maps/api/geocode/json?address=".$calle.", ".$comuna."&key=".$key);
        $url = str_replace("%3A", ":", $url);
        $url = str_replace("%2F", "/", $url);
        $url = str_replace("%3F", "?", $url);
        $url = str_replace("%3D", "=", $url);
        $url = str_replace("%2B", "+", $url);
        $url = str_replace("%2C", ",", $url);
        $url = str_replace("%26", "&", $url);
        $url = str_replace("%C3%A1", "á", $url);
        $url = str_replace("%C3%A9", "é", $url);
        $url = str_replace("%C3%AD", "í", $url);
        $url = str_replace("%C3%B3", "ó", $url);
        $url = str_replace("%C3%BA", "ú", $url);
        $url = str_replace("%C3%B1", "ñ", $url);
        $json = json_decode(file_get_contents($url), true);
        for($i = 0; $i < count($json['results']); $i++){
            if(Str::contains($json['results'][$i]['formatted_address'], $comuna)){
                $latitud = $json['results'][$i]['geometry']['location']['lat'];
                $longitud = $json['results'][$i]['geometry']['location']['lng'];
            }
        }
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

        return back()->with('exito1','Petición ingresada correctamente. Se debe esperar a la aprobación de un Administrador');

    }

    public function actualizarPendiente(Request $request){

        $idEmpresa = request()->idEmpresa;
        $nombreEmpresa = request()->nombreEmpresa;
        $rutEmpresa = request()->rutEmpresa;
        $queOfrece = request()->queOfrece;
        $calle = request()->calle;
        $horario = request()->horario;
        $facebook = request()->facebook;
        $instagram = request()->instagram;
        $formalizado = request()->formalizado;
        $comuna = request()->comuna;
        $contacto = request()->contacto;
        $telefono = request()->telefono;
        $email = request()->email;
        $latitud = request()->latitud;
        $longitud = request()->longitud;
        $descripcion = request()->descripcion;

        if($nombreEmpresa != null){
            DB::table('formularios')
                ->where('id', $idEmpresa)
                ->update(['nombre_empresa' => $nombreEmpresa]);
        }

        if($rutEmpresa != null){
            DB::table('formularios')
                ->where('id', $idEmpresa)
                ->update(['rut_empresa' => $rutEmpresa]);
        }

        if($queOfrece != null){
            DB::table('formularios')
                ->where('id', $idEmpresa)
                ->update(['categoria' => $queOfrece]);
        }

        if($calle != null){

            $key = 'AIzaSyAIuJCrwX-2-hqArtpPyTEn340ezoucpS4';
            $url = urlencode("https://maps.googleapis.com/maps/api/geocode/json?address=".$calle.", ".$comuna."&key=".$key);
            $url = str_replace("%3A", ":", $url);
            $url = str_replace("%2F", "/", $url);
            $url = str_replace("%3F", "?", $url);
            $url = str_replace("%3D", "=", $url);
            $url = str_replace("%2B", "+", $url);
            $url = str_replace("%2C", ",", $url);
            $url = str_replace("%26", "&", $url);
            $url = str_replace("%C3%A1", "á", $url);
            $url = str_replace("%C3%A9", "é", $url);
            $url = str_replace("%C3%AD", "í", $url);
            $url = str_replace("%C3%B3", "ó", $url);
            $url = str_replace("%C3%BA", "ú", $url);
            $url = str_replace("%C3%B1", "ñ", $url);
            $json = json_decode(file_get_contents($url), true);
            for($i = 0; $i < count($json['results']); $i++){
                if(Str::contains($json['results'][$i]['formatted_address'], $comuna)){
                    $latitud = $json['results'][$i]['geometry']['location']['lat'];
                    $longitud = $json['results'][$i]['geometry']['location']['lng'];
                }
            }
            DB::table('formularios')
                ->where('id', $idEmpresa)
                ->update(['ubicacion' => $calle]);

            DB::table('formularios')
                ->where('id', $idEmpresa)
                ->update(['latitud' => $latitud]);

            DB::table('formularios')
                ->where('id', $idEmpresa)
                ->update(['longitud' => $longitud]);
        }

        if($horario != null){
            DB::table('formularios')
                ->where('id', $idEmpresa)
                ->update(['horario' => $horario]);
        }

        if($facebook != null){
            DB::table('formularios')
                ->where('id', $idEmpresa)
                ->update(['facebook' => $facebook]);
        }

        if($instagram != null){
            DB::table('formularios')
                ->where('id', $idEmpresa)
                ->update(['instagram' => $instagram]);
        }

        if($formalizado != null){
            DB::table('formularios')
                ->where('id', $idEmpresa)
                ->update(['formalizado' => $formalizado]);
        }

        if($comuna != null){
            DB::table('formularios')
                ->where('id', $idEmpresa)
                ->update(['comuna' => $comuna]);
        }

        if($contacto != null){
            DB::table('formularios')
                ->where('id', $idEmpresa)
                ->update(['contacto' => $contacto]);
        }

        if($telefono != null){
            DB::table('formularios')
                ->where('id', $idEmpresa)
                ->update(['telefono' => $telefono]);
        }

        if($email != null){
            DB::table('formularios')
                ->where('id', $idEmpresa)
                ->update(['mail' => $email]);
        }


        return back()->with('exito1','Formulario Actualizado con Éxito');

    }

    public function actualizarAprobado(Request $request){

        $idEmpresa = request()->idEmpresa;
        $nombreEmpresa = request()->nombreEmpresa;
        $rutEmpresa = request()->rutEmpresa;
        $queOfrece = request()->queOfrece;
        $calle = request()->calle;
        $horario = request()->horario;
        $facebook = request()->facebook;
        $instagram = request()->instagram;
        $formalizado = request()->formalizado;
        $comuna = request()->comuna;
        $contacto = request()->contacto;
        $telefono = request()->telefono;
        $email = request()->email;
        $latitud = request()->latitud;
        $longitud = request()->longitud;
        $descripcion = request()->descripcion;

        if($queOfrece != null){
            DB::table('formularios_aprobados')
                ->where('id', $idEmpresa)
                ->update(['categoria' => $queOfrece]);
        }

        if($calle != null){

            $key = 'AIzaSyAIuJCrwX-2-hqArtpPyTEn340ezoucpS4';
            $url = urlencode("https://maps.googleapis.com/maps/api/geocode/json?address=".$calle.", ".$comuna."&key=".$key);
            $url = str_replace("%3A", ":", $url);
            $url = str_replace("%2F", "/", $url);
            $url = str_replace("%3F", "?", $url);
            $url = str_replace("%3D", "=", $url);
            $url = str_replace("%2B", "+", $url);
            $url = str_replace("%2C", ",", $url);
            $url = str_replace("%26", "&", $url);
            $url = str_replace("%C3%A1", "á", $url);
            $url = str_replace("%C3%A9", "é", $url);
            $url = str_replace("%C3%AD", "í", $url);
            $url = str_replace("%C3%B3", "ó", $url);
            $url = str_replace("%C3%BA", "ú", $url);
            $url = str_replace("%C3%B1", "ñ", $url);
            $json = json_decode(file_get_contents($url), true);
            for($i = 0; $i < count($json['results']); $i++){
                if(Str::contains($json['results'][$i]['formatted_address'], $comuna)){
                    $latitud = $json['results'][$i]['geometry']['location']['lat'];
                    $longitud = $json['results'][$i]['geometry']['location']['lng'];
                }
            }
            DB::table('formularios_aprobados')
                ->where('id', $idEmpresa)
                ->update(['ubicacion' => $calle]);

            DB::table('formularios_aprobados')
                ->where('id', $idEmpresa)
                ->update(['latitud' => $latitud]);

            DB::table('formularios_aprobados')
                ->where('id', $idEmpresa)
                ->update(['longitud' => $longitud]);
        }

        if($nombreEmpresa != null){
            DB::table('formularios_aprobados')
                ->where('id', $idEmpresa)
                ->update(['nombre_empresa' => $nombreEmpresa]);
        }

        if($rutEmpresa != null){
            DB::table('formularios_aprobados')
                ->where('id', $idEmpresa)
                ->update(['rut_empresa' => $rutEmpresa]);
        }

        if($horario != null){
            DB::table('formularios_aprobados')
                ->where('id', $idEmpresa)
                ->update(['horario' => $horario]);
        }

        if($facebook != null){
            DB::table('formularios_aprobados')
                ->where('id', $idEmpresa)
                ->update(['facebook' => $facebook]);
        }

        if($instagram != null){
            DB::table('formularios_aprobados')
                ->where('id', $idEmpresa)
                ->update(['instagram' => $instagram]);
        }

        if($formalizado != null){
            DB::table('formularios_aprobados')
                ->where('id', $idEmpresa)
                ->update(['formalizado' => $formalizado]);
        }

        if($comuna != null){
            DB::table('formularios_aprobados')
                ->where('id', $idEmpresa)
                ->update(['comuna' => $comuna]);
        }

        if($contacto != null){
            DB::table('formularios_aprobados')
                ->where('id', $idEmpresa)
                ->update(['contacto' => $contacto]);
        }

        if($telefono != null){
            DB::table('formularios_aprobados')
                ->where('id', $idEmpresa)
                ->update(['telefono' => $telefono]);
        }

        if($email != null){
            DB::table('formularios_aprobados')
                ->where('id', $idEmpresa)
                ->update(['mail' => $email]);
        }


        return back()->with('exito1','Formulario Actualizado con Éxito');

    }


}
