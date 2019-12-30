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
        $latitud = request()->latitud;
        $longitud = request()->longitud;
        $rutaImagen = $request->file('archivo')->store('public');
        $rutaImagen = str_replace("public/", "", $rutaImagen);

        //http://kml4earth.appspot.com/icons.html

        $icono = $this->agregarIcono($queOfrece);

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

        //http://kml4earth.appspot.com/icons.html

        $icono = $this->agregarIcono($queOfrece);

        DB::table('formularios')->where('id', $idEmpresa)->update(['nombre_empresa' => $nombreEmpresa,
            'rut_empresa' => $rutEmpresa, 'categoria' => $queOfrece, 'ubicacion' => $calle, 'latitud' => $latitud,
            'longitud' => $longitud,'horario' => $horario,'facebook' => $facebook,'instagram' => $instagram,
            'url' => $url,'formalizado' => $formalizado,'comuna' => $comuna,'contacto' => $contacto,
            'telefono' => $telefono, 'mail' => $email,'descripcion' => $descripcion, 'icono' => $icono]);

        return back()->with('exito1','Formulario Actualizado con Éxito');

    }

    public function actualizarAprobado(Request $request){

        self::validar($request);

        $idEmpresa = request()->idEmpresa;
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
        $latitud = request()->latitud;
        $longitud = request()->longitud;
        $descripcion = request()->descripcion;

        //http://kml4earth.appspot.com/icons.html

        $icono = $this->agregarIcono($queOfrece);

        DB::table('formularios_aprobados')->where('id', $idEmpresa)->update(['nombre_empresa' => $nombreEmpresa,
            'rut_empresa' => $rutEmpresa, 'categoria' => $queOfrece, 'ubicacion' => $calle, 'latitud' => $latitud,
            'longitud' => $longitud,'horario' => $horario,'facebook' => $facebook,'instagram' => $instagram,
            'url' => $url,'formalizado' => $formalizado,'comuna' => $comuna,'contacto' => $contacto,
            'telefono' => $telefono, 'mail' => $email,'descripcion' => $descripcion, 'icono' => $icono]);

        return back()->with('exito1','Formulario Actualizado con Éxito');

    }

    function agregarIcono($queOfrece){

        $icono = "null";

        if($queOfrece == "Agricultura, ganadería, silvicultura y pesca"){
            $icono = "http://maps.google.com/mapfiles/kml/pal2/icon12.png";
        }
        if($queOfrece == "Explotación de minas y canteras"){
            $icono = "http://maps.google.com/mapfiles/kml/pal3/icon58.png";
        }
        if($queOfrece == "Industria manufacturera"){
            $icono = "http://maps.google.com/mapfiles/kml/pal3/icon29.png";
        }
        if($queOfrece == "Suministro de electricidad, gas, vapor y aire acondicionado"){
            $icono = "http://maps.google.com/mapfiles/kml/pal4/icon30.png";
        }
        if($queOfrece == "Suministro de agua; evacuación de aguas residuales, gestión de desechos y descontaminación"){
            $icono = "http://maps.google.com/mapfiles/kml/pal3/icon47.png";
        }
        if($queOfrece == "Construcción"){
            $icono = "http://maps.google.com/mapfiles/kml/pal3/icon21.png";
        }
        if($queOfrece == "Comercio al por mayor y al por menor; reparación de vehiculos automotores y motocicletas"){
            $icono = "http://maps.google.com/mapfiles/kml/pal2/icon58.png";
        }
        if($queOfrece == "Transporte y almacenamiento"){
            $icono = "http://maps.google.com/mapfiles/kml/pal2/icon47.png";
        }
        if($queOfrece == "Actividades de alojamiento y de servicio de comidas"){
            $icono = "http://maps.google.com/mapfiles/kml/pal2/icon63.png";
        }
        if($queOfrece == "Información y comunicaciones"){
            $icono = "http://maps.google.com/mapfiles/kml/pal3/icon30.png";
        }
        if($queOfrece == "Actividades financieras y de seguros"){
            $icono = "http://maps.google.com/mapfiles/kml/pal4/icon8.png";
        }
        if($queOfrece == "Actividades inmobiliarias"){
            $icono = "http://maps.google.com/mapfiles/kml/pal5/icon12.png";
        }
        if($queOfrece == "Actividades profesionales, cientificas y técnicas"){
            $icono = "http://maps.google.com/mapfiles/kml/pal4/icon37.png";
        }
        if($queOfrece == "Actividades de servicios administrativos y de apoyo"){
            $icono = "http://maps.google.com/mapfiles/kml/pal5/icon5.png";
        }
        if($queOfrece == "Administración pública y defensa; planes de seguridad social de afiliación obligatoria"){
            $icono = "http://maps.google.com/mapfiles/kml/pal2/icon25.png";
        }
        if($queOfrece == "Enseñanza"){
            $icono = "http://maps.google.com/mapfiles/kml/pal2/icon14.png";
        }
        if($queOfrece == "Actividades de atención de la salud humana y de asistencia social"){
            $icono = "http://maps.google.com/mapfiles/kml/pal3/icon46.png";
        }
        if($queOfrece == "Actividades artísticas, de entretenimiento y recreativas"){
            $icono = "http://maps.google.com/mapfiles/kml/pal2/icon57.png";
        }
        if($queOfrece == "Otras actividades de servicios"){
            $icono = "http://maps.google.com/mapfiles/kml/pal3/icon44.png";
        }


        return $icono;
    }


}
