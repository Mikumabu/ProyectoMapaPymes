<!DOCTYPE html>
<html>
    <head>
        <title>Simple Map</title>
        <meta name="viewport" content="initial-scale=1.0">
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{asset('/css/index.css')}}">
    </head>
    <body>
        <div class="nav">
            Mapa PYMES
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/Administrador') }}">Panel Administración</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            @endif
        </div>
        <div>
            <br>
        </div>
        <div id="presentacion">
            Este mapa contiene las PYMES (Pequeñas y medianas empresas) del país
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
