<?php
namespace App\Http\Controllers;
 
use Appitventures\Phpgmaps\Phpgmaps;
use Mapper;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mail;


class MapaController extends Controller {

    public function maps() {
        Mapper::map(-23.6, -70.4, ['zoom' => 14, 'marker' => false]);
        $users = DB::table('formularios_aprobados')->get();
        foreach($users as $user){
            $nombreEmpresa = $user->nombre_empresa;
            $queOfrece = $user->categoria;
            $calle = $user->ubicacion;
            $horario = $user->horario;
            $facebook = $user->facebook;
            $instagram = $user->instagram;
            $formalizado = $user->formalizado;
            $comuna = $user->comuna;
            $contacto = $user->contacto;
            $telefono = $user->telefono;
            $email = $user->mail;
            $descripcion = $user->descripcion;
            $latitud = $user->latitud;
            $longitud = $user->longitud;
            Mapper::informationWindow($latitud, $longitud, '<b>Nombre Empresa: </b>'.$nombreEmpresa.'<br><b>Descripción: </b>'.$descripcion.
                '<br><b>¿Qué ofrece? </b>'.$queOfrece.'<br><b>Dirección: </b>'.$calle.'<br><b>Ciudad: </b>'.$comuna.'
                <br><b>Horario atención: </b>'.$horario.'<br><b>¿Formalizado? </b>'.$formalizado.'<br><b>Contacto: </b>'
                .$contacto.'<br><b>Teléfono: </b>'.$telefono.'<br><b>Correo: </b>'.$email.'<br><br><a href="'.$facebook.'">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/Facebook_icon_2013.svg/1024px-Facebook_icon_2013.svg.png"
                width="20" height="20"></a> <a href="'.$instagram.'"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/58/Instagram-Icon.png/600px-Instagram-Icon.png"
                width="20" height="20"></a>', ['maxWidth' => 300, 'marker' => true/*, 'icon' => 'http://icons.iconarchive.com/icons/icons-land/points-of-interest/128/Golf-Club-Green-2-icon.png'*/]);
        }
        return view('Mapa/PruebaMapa');
    }

    public function seleccionarPosicion(){
        Mapper::map(-23.6, -70.4, ['zoom' => 14, 'marker' => false]);
        $newlat = 0;
        $newlong = 0;
        Mapper::marker(-23.6, -70.4, ['draggable' => true, 'eventDragEnd' => '$newlat = event.latLng.lat(); $newlong = event.latLng.lng(); document.getElementById("latitud").value = $newlat; document.getElementById("longitud").value = $newlong']);
        return view('Formulario/Formulario');
    }

    public function editarMapa($id){
        $formularios = DB::table('formularios')->where('id', $id)->first();
        Mapper::map($formularios->latitud, $formularios->longitud, ['zoom' => 14, 'marker' => false]);
        $newlat = 0;
        $newlong = 0;
        Mapper::marker($formularios->latitud, $formularios->longitud, ['draggable' => true, 'eventDragEnd' => '$newlat = event.latLng.lat(); $newlong = event.latLng.lng(); document.getElementById("latitud").value = $newlat; document.getElementById("longitud").value = $newlong']);
        return view('Administrador/AdministradorEditarPendientes',compact('formularios', 'request'));
    }

    public function editarMapaAdmin($id){
        $formularios = DB::table('formularios_aprobados')->where('id', $id)->first();
        Mapper::map($formularios->latitud, $formularios->longitud, ['zoom' => 14, 'marker' => false]);
        $newlat = 0;
        $newlong = 0;
        Mapper::marker($formularios->latitud, $formularios->longitud, ['draggable' => true, 'eventDragEnd' => '$newlat = event.latLng.lat(); $newlong = event.latLng.lng(); document.getElementById("latitud").value = $newlat; document.getElementById("longitud").value = $newlong']);
        return view('Administrador/AdministradorEditarAprobados',compact('formularios', 'request'));
    }

    public function test(){
        Mapper::map(-23.6, -70.4, ['zoom' => 14, 'marker' => false]);
        $newlat = 0;
        $newlong = 0;
        Mapper::marker(-23.6, -70.4, ['draggable' => true, 'eventDragEnd' => '$newlat = event.latLng.lat(); $newlong = event.latLng.lng(); document.getElementById("latitud").value = $newlat; document.getElementById("longitud").value = $newlong']);
        return view('Mapa/TestMapa');
    }

    public function buscador(Request $request) {

        $datos =  DB::select('select id, nombre_empresa, rut_empresa, categoria, ubicacion, horario, facebook,
        instagram, formalizado, comuna, contacto, telefono, mail, descripcion, latitud, longitud
        from formularios_aprobados where categoria = :categoria', ['categoria' => $request->categoria]);

        Mapper::map(-23.6, -70.4, ['zoom' => 14, 'marker' => false]);
        $users = DB::table('formularios_aprobados')->get();
        foreach($datos as $dato){
            $nombreEmpresa = $dato->nombre_empresa;
            $queOfrece = $dato->categoria;
            $calle = $dato->ubicacion;
            $horario = $dato->horario;
            $facebook = $dato->facebook;
            $instagram = $dato->instagram;
            $formalizado = $dato->formalizado;
            $comuna = $dato->comuna;
            $contacto = $dato->contacto;
            $telefono = $dato->telefono;
            $email = $dato->mail;
            $descripcion = $dato->descripcion;
            $latitud = $dato->latitud;
            $longitud = $dato->longitud;
            Mapper::informationWindow($latitud, $longitud, '<b>Nombre Empresa: </b>'.$nombreEmpresa.'<br><b>Descripción: </b>'.$descripcion.
                '<br><b>¿Qué ofrece? </b>'.$queOfrece.'<br><b>Dirección: </b>'.$calle.'<br><b>Ciudad: </b>'.$comuna.'
                <br><b>Horario atención: </b>'.$horario.'<br><b>¿Formalizado? </b>'.$formalizado.'<br><b>Contacto: </b>'
                .$contacto.'<br><b>Teléfono: </b>'.$telefono.'<br><b>Correo: </b>'.$email.'<br><br><a href="'.$facebook.'">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/Facebook_icon_2013.svg/1024px-Facebook_icon_2013.svg.png"
                width="20" height="20"></a> <a href="'.$instagram.'"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/58/Instagram-Icon.png/600px-Instagram-Icon.png"
                width="20" height="20"></a>', ['maxWidth' => 300, 'marker' => true/*, 'icon' => 'http://icons.iconarchive.com/icons/icons-land/points-of-interest/128/Golf-Club-Green-2-icon.png'*/]);
        }
        return view('Mapa/PruebaMapa');
    }


}
