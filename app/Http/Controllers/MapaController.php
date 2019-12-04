<?php
namespace App\Http\Controllers;
 
use Appitventures\Phpgmaps\Phpgmaps;
use Mapper;
class MapaController extends Controller {
    public function maps() {
        Mapper::map(-23.6, -70.4, ['zoom' => 14]);
        Mapper::informationWindow(-23.679280, -70.409252, 'Content', ['maxWidth' => 200, 'markers' => ['title', 'Tittle']]);
        return view('Mapa/PruebaMapa');
    }
}