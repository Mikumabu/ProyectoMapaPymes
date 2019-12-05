<?php
namespace App\Http\Controllers;
 
use Appitventures\Phpgmaps\Phpgmaps;
use Mapper;
use Illuminate\Support\Facades\DB;
class MapaController extends Controller {
    public function maps() {
        Mapper::map(-23.6, -70.4, ['zoom' => 14, 'marker' => false]);
        $lat = DB::table('formularios')->value('latitud');
        $lng = DB::table('formularios')->value('longitud');
        Mapper::informationWindow($lat, $lng, 'Content', ['maxWidth' => 200, 'marker' => true, 'icon' => 'http://icons.iconarchive.com/icons/icons-land/points-of-interest/128/Golf-Club-Green-2-icon.png']);
        return view('Mapa/PruebaMapa');
    }
}