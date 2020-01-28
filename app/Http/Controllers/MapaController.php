<?php
namespace App\Http\Controllers;
 
use Appitventures\Phpgmaps\Phpgmaps;
use Mapper;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Storage;

class MapaController extends Controller {

    /* Método que despliega el Mapa inicial, mostrando los Formularios de las Empresas que estén aprobados en la tabla
      "formularios_aprobados". También muestra un Banner distinto en caso que sea el Administrador quien esté en la
       Vista del Mapa */

    public function maps() {
        Mapper::map(-23.6, -70.4, ['locate' => true, 'zoom' => 14, 'marker' => false]);
        $users = DB::table('formularios_aprobados')->get();
        $this->generateInfoWindow($users);
        return view('Mapa/PruebaMapa');
    }

    /* Método que permite seleccionar la ubicación de una Empresa en el Mapa cuando se quiere enviar un Formulario */

    public function seleccionarPosicion(){
        Mapper::map(-23.6, -70.4, ['zoom' => 14, 'marker' => false]);
        $newlat = -23.6;
        $newlong = -70.4;
        Mapper::marker(-23.6, -70.4, ['locate' => true, 'draggable' => true, 'eventDragEnd' => '$newlat = event.latLng.lat(); $newlong = event.latLng.lng(); document.getElementById("latitud").value = $newlat; document.getElementById("longitud").value = $newlong']);
        return view('Formulario/Formulario');
    }

    /* Método que permite seleccionar la ubicación de una Empresa en el Mapa cuando se quiere editar un Formulario
       Pendiente desde el Administrador */

    public function editarMapa($id){
        $formularios = DB::table('formularios')->where('id', $id)->first();
        Mapper::map($formularios->latitud, $formularios->longitud, ['zoom' => 14, 'marker' => false]);
        $newlat = $formularios->latitud;
        $newlong = $formularios->longitud;
        Mapper::marker($formularios->latitud, $formularios->longitud, ['draggable' => true, 'eventDragEnd' => '$newlat = event.latLng.lat(); $newlong = event.latLng.lng(); document.getElementById("latitud").value = $newlat; document.getElementById("longitud").value = $newlong']);
        return view('Administrador/AdministradorEditarPendientes',compact('formularios', 'request'));
    }

    /* Método que permite seleccionar la ubicación de una Empresa en el Mapa cuando se quiere editar un Formulario
       Aprobado desde el Administrador */

    public function editarMapaAdmin($id){
        $formularios = DB::table('formularios_aprobados')->where('id', $id)->first();
        Mapper::map($formularios->latitud, $formularios->longitud, ['zoom' => 14, 'marker' => false]);
        $newlat = $formularios->latitud;
        $newlong = $formularios->longitud;
        Mapper::marker($formularios->latitud, $formularios->longitud, ['draggable' => true, 'eventDragEnd' => '$newlat = event.latLng.lat(); $newlong = event.latLng.lng(); document.getElementById("latitud").value = $newlat; document.getElementById("longitud").value = $newlong']);
        return view('Administrador/AdministradorEditarAprobados',compact('formularios', 'request'));
    }

    /* Método que recibe la Categoría del correspondiente filtro que se encuentra en la Vista del Mapa. Esta Categoría
       es recibida y despliega todas las Empresas que tengan dicha Categoría, enviándolas a la Vista del Mapa */

    public function buscador(Request $request) {
        $datos = DB::table('formularios_aprobados')->where('categoria', $request->categoria)->get();
        Mapper::map(-23.6, -70.4, ['locate' => true, 'zoom' => 14, 'marker' => false]);
        $this->generateInfoWindow($datos);
        return view('Mapa/PruebaMapa');
    }

    /* Método que recibe alguna palabra clave que permita filtrar dependiendo de la Descripción de una Empresa, si
       se encuentra una Descripción que coincida con dicha palabra, muestra en el Mapa todas las Empresas correspondientes */

    public function buscarDescripcion(Request $request){
        $datos = DB::table('formularios_aprobados')->where('descripcion', 'LIKE', '%'.$request->descripcion.'%')->get();
        if($datos == ""){
            Session::flash('notFound', 'No se encontró una empresa con esa descripción');
            return View::make('Mensajes');
        }
        Mapper::map(-23.6, -70.4, ['locate' => true, 'zoom' => 14, 'marker' => false]);
        $this->generateInfoWindow($datos);
        return view('Mapa/PruebaMapa');
    }

    /* Método que muestra la información de las Empresas en el Mapa cuando se selecciona su ubicación. Estas Empresas
       se encuentran en "formularios_aprobados" */

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
            $datosMapa ='<br><img src="'.Storage::url($imagen).'" style="max-width:150px;">
                         <br><b>Nombre Empresa: </b>'.$nombreEmpresa.
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
                         width="25" height="25"></a>';
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
                ['maxWidth' => 300, 'marker' => true, 'icon' => ['url' => $icono, 'size' => 32], 'autoClose' => true]);
        }
    }
}
