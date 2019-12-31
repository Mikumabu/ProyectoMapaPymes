<?php
namespace App\Http\Controllers;
 
use Appitventures\Phpgmaps\Phpgmaps;
use Mapper;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Storage;

class MapaController extends Controller {

    public function maps() {
        Mapper::map(-23.6, -70.4, ['locate' => true, 'zoom' => 14, 'marker' => false]);
        $users = DB::table('formularios_aprobados')->get();
        $this->generateInfoWindow($users);
        return view('Mapa/PruebaMapa');
    }

    public function seleccionarPosicion(){
        Mapper::map(-23.6, -70.4, ['zoom' => 14, 'marker' => false]);
        $newlat = -23.6;
        $newlong = -70.4;
        Mapper::marker(-23.6, -70.4, ['locate' => true, 'draggable' => true, 'eventDragEnd' => '$newlat = event.latLng.lat(); $newlong = event.latLng.lng(); document.getElementById("latitud").value = $newlat; document.getElementById("longitud").value = $newlong']);
        return view('Formulario/Formulario');
    }

    public function editarMapa($id){
        $formularios = DB::table('formularios')->where('id', $id)->first();
        Mapper::map($formularios->latitud, $formularios->longitud, ['zoom' => 14, 'marker' => false]);
        $newlat = $formularios->latitud;
        $newlong = $formularios->longitud;
        Mapper::marker($formularios->latitud, $formularios->longitud, ['draggable' => true, 'eventDragEnd' => '$newlat = event.latLng.lat(); $newlong = event.latLng.lng(); document.getElementById("latitud").value = $newlat; document.getElementById("longitud").value = $newlong']);
        return view('Administrador/AdministradorEditarPendientes',compact('formularios', 'request'));
    }

    public function editarMapaAdmin($id){
        $formularios = DB::table('formularios_aprobados')->where('id', $id)->first();
        Mapper::map($formularios->latitud, $formularios->longitud, ['zoom' => 14, 'marker' => false]);
        $newlat = $formularios->latitud;
        $newlong = $formularios->longitud;
        Mapper::marker($formularios->latitud, $formularios->longitud, ['draggable' => true, 'eventDragEnd' => '$newlat = event.latLng.lat(); $newlong = event.latLng.lng(); document.getElementById("latitud").value = $newlat; document.getElementById("longitud").value = $newlong']);
        return view('Administrador/AdministradorEditarAprobados',compact('formularios', 'request'));
    }

    public function buscador(Request $request) {
        $datos = DB::table('formularios_aprobados')->where('categoria', $request->categoria)->get();
        Mapper::map(-23.6, -70.4, ['locate' => true, 'zoom' => 14, 'marker' => false]);
        $this->generateInfoWindow($datos);
        return view('Mapa/PruebaMapa');
    }

    public function buscarDescripcion(Request $request){
        $datos = DB::table('formularios_aprobados')->where('descripcion', 'LIKE', '%'.$request->descripcion.'%')->get();
        if($datos == ""){
            dd("holi");
            Session::flash('notFound', 'No se encontró una empresa con esa descripción');
            return View::make('Mensajes');
        }
        Mapper::map(-23.6, -70.4, ['locate' => true, 'zoom' => 14, 'marker' => false]);
        $this->generateInfoWindow($datos);
        return view('Mapa/PruebaMapa');
    }

    public function generateInfoWindow($datas){
        foreach($datas as $data){
            $nombreEmpresa = $data->nombre_empresa;
            $queOfrece = $data->categoria;
            $calle = $data->ubicacion;
            $horario = $data->horario;
            $facebook = $data->facebook;
            $instagram = $data->instagram;
            $url = $data->url;
            $formalizado = $data->formalizado;
            $comuna = $data->comuna;
            $contacto = $data->contacto;
            $telefono = $data->telefono;
            $email = $data->mail;
            $descripcion = $data->descripcion;
            $latitud = $data->latitud;
            $longitud = $data->longitud;
            $icono = $data->icono;
            $imagen = $data->imagen;
            $datosMapa ='<b>Nombre Empresa: </b>'.$nombreEmpresa.
                        '<br><b>Descripción: </b>'.$descripcion.
                        '<br><b>¿Qué ofrece? </b>'.$queOfrece.
                        '<br><b>Dirección: </b>'.$calle.
                        '<br><b>Ciudad: </b>'.$comuna.
                        '<br><b>Horario atención: </b>'.$horario.
                        '<br><b>¿Formalizado? </b>'.$formalizado.
                        '<br><b>Contacto: </b>'.$contacto.
                        '<br><b>Teléfono: </b>'.$telefono.
                        '<br><b>Correo: </b>'.$email.
                        '<br><br><a href="'.$facebook.'"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/Facebook_icon_2013.svg/1024px-Facebook_icon_2013.svg.png"
                         width="25" height="25"></a>
                         <a href="'.$instagram.'"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/58/Instagram-Icon.png/600px-Instagram-Icon.png"
                         width="25" height="25"></a>
                         <a href="'.$url.'"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/58/Instagram-Icon.png/600px-Instagram-Icon.png"
                         width="25" height="25"></a>
                         <br><img src="'.Storage::url($imagen).'" style="max-width:150px;">';
            if($facebook == null){
                $datosMapa = str_replace("<a href=\"\"><img src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/Facebook_icon_2013.svg/1024px-Facebook_icon_2013.svg.png\"
                         width=\"25\" height=\"25\">", "", $datosMapa);
            }
            if($instagram == null){
                $datosMapa = str_replace("<a href=\"\"><img src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/5/58/Instagram-Icon.png/600px-Instagram-Icon.png\"
                         width=\"25\" height=\"25\"></a>", "", $datosMapa);
            }
            if($url == null){
                $datosMapa = str_replace("<a href=\"\"><img src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/5/58/Instagram-Icon.png/600px-Instagram-Icon.png\"
                         width=\"25\" height=\"25\"></a>", "", $datosMapa);
            }
            Mapper::informationWindow($latitud, $longitud, $datosMapa,
                ['maxWidth' => 300, 'marker' => true, 'icon' => $icono]);
        }
    }
}
