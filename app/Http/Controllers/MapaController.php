<?php
namespace App\Http\Controllers;
 
use Appitventures\Phpgmaps\Phpgmaps;
use Mapper;
use Illuminate\Support\Facades\DB;
class MapaController extends Controller {
    public function maps() {
        Mapper::map(-23.6, -70.4, ['zoom' => 14, 'marker' => false]);
        $users = DB::table('formularios_aprobados')->get();
        foreach($users as $user){
            $nombreEmpresa = $user->nombre_empresa;
            $rutEmpresa = $user->rut_empresa;
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
            Mapper::informationWindow($latitud, $longitud, '<b>Nombre Empresa: </b>'.$nombreEmpresa.'<br><b>RUT: </b>'.$rutEmpresa.
                '<br><b>¿Qué ofrece? </b>'.$queOfrece.'<br><b>Dirección: </b>'.$calle.'<br><b>Horario atención: </b>'.$horario.
                '<br><b>¿Formalizado? </b>'.$formalizado.'<br><b>Ciudad: </b>'.$comuna.'<br><b>Contacto: </b>'.$contacto.
                '<br><b>Teléfono: </b>'.$telefono.'<br><b>Correo: </b>'.$email.'<br><b>Descripción: </b>'.$descripcion.
                '<br><br><a href="https://www.facebook.com/"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/Facebook_icon_2013.svg/1024px-Facebook_icon_2013.svg.png"
                width="20" height="20"></a> <a href="https://www.instagram.com/"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/58/Instagram-Icon.png/600px-Instagram-Icon.png"
                width="20" height="20"></a>', ['maxWidth' => 300, 'marker' => true/*, 'icon' => 'http://icons.iconarchive.com/icons/icons-land/points-of-interest/128/Golf-Club-Green-2-icon.png'*/]);
        }
        return view('Mapa/PruebaMapa');
    }
}
