<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

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
        <div class="flash-message"></div>
        <div id="presentacion">
            Este mapa contiene las PYMES (Pequeñas y medianas empresas) del país <a href="{{ route('formulario') }}">Ingrese su PYME</a>
        </div>
        <div class="row">
            <div class="col-sm-3 m-auto">
                <form method="POST" action="{{ route('filtrar') }}" id="form-id" class="d-inline">
                    {{ csrf_field() }}
                    <?php
                        $datos = DB::table('formularios_aprobados')->select('categoria')->distinct()->get();
                    ?>
                    <p>Filtrar por Categoría
                        <select
                                id="categoria"
                                name="categoria"
                                class="form-control"
                                required>
                            <option value="">Seleccione una Categoría</option>
                            @foreach($datos as $dato)
                                <option value="{{ $dato->categoria }}">
                                    {{ $dato->categoria }}
                                </option>
                            @endforeach
                        </select>
                    </p>
                    <div class="d-inline">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Buscar por categoría') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class ="col-sm-3 m-auto">
                <form method="POST" action="{{ route('filtrarDescripcion') }}" id="form-escrito" class="d-inline">
                    {{ csrf_field() }}
                        <p>Búsqueda emprendimiento
                            <input type="text"
                                   class="form-control"
                                   name="descripcion"
                                   id="descripcion"
                                   placeholder="¿Qué tipo de emprendimiento busca?">

                        </p>
                    <div class="d-inline">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Buscar por descripción') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <br>
        </div>
        <div id="map">
            {!! Mapper::render(0) !!}
        </div>
    </body>
</html>
