<!DOCTYPE html>
<html>
    <head>
        <title>Simple Map</title>
        <meta name="viewport" content="initial-scale=1.0">
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{asset('/css/index.css')}}">
    </head>
    <body>
        @include('navbar.navbar')
        <div>
            <br>
        </div>
        <div id="presentacion">
            Este mapa contiene las PYMES (Pequeñas y medianas empresas) del país <a href="{{ url('/Formulario') }}">Ingrese su PYME</a>
        </div>
        <div>
            <br>
        </div>
        <div id="map">
            {!! Mapper::render() !!}
        </div>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIuJCrwX-2-hqArtpPyTEn340ezoucpS4&callback=initMap"
                async defer></script>
    </body>
</html>
