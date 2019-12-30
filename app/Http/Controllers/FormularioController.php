<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\formulario;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;
use PhpParser\Node\Expr\Cast\Object_;
use Session;
use View;

class FormularioController extends Controller
{
    public function validar(Request $request){
        $formalizado = $request->get('formalizado');
        $reglas = [
            'nombreEmpresa' => 'required',
            'rutEmpresa' => 'nullable',
            'queOfrece' => 'required',
            'calle' => 'required',
            'horario' => 'required',
            'facebook' => 'url|nullable',
            'instagram' => 'url|nullable',
            'url' => 'url|nullable',
            'comuna' => 'required',
            'contacto' => 'required',
            'telefono' => 'required',
            'email' => 'required|email',
            'descripcion' => 'required|max:500'
        ];
        if($formalizado == "Si"){
            $reglas['rutEmpresa'] = 'required|cl_rut';
        }
        $mensajes=[
            'nombreEmpresa.required' => 'El nombre de la empresa es obligatorio.',
            'rutEmpresa.required' => 'El rut es obligatorio si está formalizado.',
            'rutEmpresa.cl_rut' => 'Rut invalido.',
            'queOfrece.required' => 'La categoría de la empresa es obligatoria.',
            'calle.required' => 'Se necesita una dirección.',
            'horario.required' => 'Es importante saber las horas que atiende.',
            'facebook.url' => 'Debe ser una dirección de facebook.',
            'instagram.url' => 'Debe ser una dirección de instagram.',
            'url.url' => 'Debe ser una dirección de sitio web u otro',
            'comuna.required' => 'Indique la comuna que se encuentra la empresa.',
            'contacto.required' => 'Indique el nombre del representante de la empresa.',
            'telefono.required' => 'El telefono de contacto es obligatorio.',
            'email.required' => 'El correo electronico es obligatorio.',
            'email.email' => 'Debe ser un correo electronico.',
            'descripcion.required' => 'Debe incluir una descripción de la empresa.',
            'descripcion.max' => 'La descripción debe ser de unos 500 carácteres.',
        ];

        $this->validate($request, $reglas, $mensajes);
    }
    public function ingresar(Request $request){

        self::validar($request);

        $nombreEmpresa = request()->nombreEmpresa;
        $rutEmpresa = request()->rutEmpresa;
        $queOfrece = request()->queOfrece;
        $calle = request()->calle;
        $horario = request()->horario;
        $facebook = request()->facebook;
        $instagram = request()->instagram;
        $url = request()->url;
        $formalizado = request()->formalizado;
        $comuna = request()->comuna;
        $contacto = request()->contacto;
        $telefono = request()->telefono;
        $email = request()->email;
        $descripcion = request()->descripcion;
        $icono = request()->icono;
        $latitud = request()->latitud;
        $longitud = request()->longitud;
        $rutaImagen = $request->file('archivo')->store('public');
        $rutaImagen = str_replace("public/", "", $rutaImagen);

        //http://kml4earth.appspot.com/icons.html

        if($queOfrece == "Educacion"){
            $icono = "http://maps.google.com/mapfiles/kml/pal2/icon14.png";
        }
        if($queOfrece == "Comida"){
            $icono = "http://maps.google.com/mapfiles/kml/pal2/icon40.png";
        }
        if($queOfrece == "Asesorias"){
            $icono = "http://maps.google.com/mapfiles/kml/pal4/icon8.png";
        }
        if($queOfrece == "Fotografia"){
            $icono = "http://maps.google.com/mapfiles/kml/pal4/icon46.png";
        }

        $insultos = DB::select('select insulto from palabras_prohibidas');
        foreach($insultos as $insulto) {

            $palabraProhibida = $insulto->insulto;
            $encontrado = strpos($descripcion, $palabraProhibida);

            if($encontrado == true){
                Session::flash('error2', 'Se encontró un insulto en la descripción');
                return View::make('Mensajes');
            }

        }

        /*$key = 'AIzaSyAIuJCrwX-2-hqArtpPyTEn340ezoucpS4';
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
        }*/
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
            'url' => $url,
            'formalizado' => $formalizado,
            'comuna' => $comuna,
            'contacto' => $contacto,
            'telefono' => $telefono,
            'mail' => $email,
            'descripcion' => $descripcion,
            'icono' => $icono,
            'imagen' => $rutaImagen
        ]);
        Session::flash('exito1', 'Petición ingresada correctamente. Se debe esperar a la aprobación de un Administrador');
        return View::make('Mensajes');

    }

    public function actualizarPendiente(Request $request){

        self::validar($request);

        $idEmpresa = request()->idEmpresa;
        $nombreEmpresa = request()->nombreEmpresa;
        $rutEmpresa = request()->rutEmpresa;

        $queOfrece = request()->queOfrece;
        $queOfrece = strtolower($queOfrece);
        $queOfrece = ucfirst($queOfrece);

        $calle = request()->calle;
        $horario = request()->horario;
        $facebook = request()->facebook;
        $instagram = request()->instagram;
        $url = request()->url;
        $formalizado = request()->formalizado;
        $comuna = request()->comuna;
        $contacto = request()->contacto;
        $telefono = request()->telefono;
        $email = request()->email;
        $latitud = request()->latitud;
        $longitud = request()->longitud;
        $descripcion = request()->descripcion;

        DB::table('formularios')->where('id', $idEmpresa)->update(['nombre_empresa' => $nombreEmpresa,
            'rut_empresa' => $rutEmpresa, 'categoria' => $queOfrece, 'ubicacion' => $calle, 'latitud' => $latitud,
            'longitud' => $longitud,'horario' => $horario,'facebook' => $facebook,'instagram' => $instagram,
            'url' => $url,'formalizado' => $formalizado,'comuna' => $comuna,'contacto' => $contacto,
            'telefono' => $telefono, 'mail' => $email,'descripcion' => $descripcion]);

        return back()->with('exito1','Formulario Actualizado con Éxito');

    }

    public function actualizarAprobado(Request $request){

        self::validar($request);

        $idEmpresa = request()->idEmpresa;
        $nombreEmpresa = request()->nombreEmpresa;
        $rutEmpresa = request()->rutEmpresa;

        $queOfrece = request()->queOfrece;
        $queOfrece = strtolower($queOfrece);
        $queOfrece = ucfirst($queOfrece);
        $calle = request()->calle;
        $horario = request()->horario;
        $facebook = request()->facebook;
        $instagram = request()->instagram;
        $url = request()->url;
        $formalizado = request()->formalizado;
        $comuna = request()->comuna;
        $contacto = request()->contacto;
        $telefono = request()->telefono;
        $email = request()->email;
        $latitud = request()->latitud;
        $longitud = request()->longitud;
        $descripcion = request()->descripcion;

        DB::table('formularios_aprobados')->where('id', $idEmpresa)->update(['nombre_empresa' => $nombreEmpresa,
            'rut_empresa' => $rutEmpresa, 'categoria' => $queOfrece, 'ubicacion' => $calle, 'latitud' => $latitud,
            'longitud' => $longitud,'horario' => $horario,'facebook' => $facebook,'instagram' => $instagram,
            'url' => $url,'formalizado' => $formalizado,'comuna' => $comuna,'contacto' => $contacto,
            'telefono' => $telefono, 'mail' => $email,'descripcion' => $descripcion]);

        return back()->with('exito1','Formulario Actualizado con Éxito');

    }

    function agregarIcono($queOfrece){

        $icono = "Hola";



        return $icono;
    }


}
