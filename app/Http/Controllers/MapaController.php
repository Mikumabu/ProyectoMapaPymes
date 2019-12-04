
<?php
namespace App\Http\Controllers;
 
use Appitventures\Phpgmaps\Phpgmaps;
 
class MapaController extends Controller {
    public function __construct() {
    }
    public function maps() {
        $marker = array();
        $config = array();
        $config['center'] = 'auto';
        $config['onboundschanged'] = 'if (!centreGot) {
                    var mapCentre = map.getCenter();
                    marker_0.setOptions({
                        position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
                    });
                }
                centreGot = true;';
        $m = new Phpgmaps($config);
        $m->add_marker($marker);
        $map = $m->create_map();
        $marker = array('map_js' => $map['js'], 'map_html' => $map['html']);
        return \Illuminate\Support\Facades\View::make('maps')->with('marker', $marker);
    }
 
}
