<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html>
    <head>
        <title>#VitrineaEmprendedores</title>
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
        <div id="presentacion" style="font-size:20px;">
            Encuentra lo que buscas en este <b>Mapa de Emprendimientos</b>
        </div>
        <div>
            <br>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-sm-3">
                <form method="POST" action="{{ route('filtrarDescripcion') }}" id="form-escrito" class="form-inline">
                    {{ csrf_field() }}
                    <input type="text"
                           class="form-control"
                           name="descripcionBusqueda"
                           id="descripcionBusqueda"
                           placeholder="¿Qué buscas?">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="col-sm-3">
                <form method="POST" action="{{ route('filtrar') }}" id="form-id" class="form-inline">
                    {{ csrf_field() }}
                    <?php
                    $datos = DB::table('formularios_aprobados')->select('categoria')->distinct()->get();
                    ?>
                    <select
                            id="categoria"
                            name="categoria"
                            class="form-control"
                            required>
                        <option value="">Selecciona una Categoría</option>
                        @foreach($datos as $dato)
                            <option value="{{ $dato->categoria }}">
                                {{ $dato->categoria }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-filter"></i>
                    </button>
                </form>
            </div>
        </div>
        <div>
            <br>
        </div>
        <div id="map">
            {!! Mapper::render(0) !!}
        </div>
        <div>
            <br>
        </div>
        <div id="creditos">
            <div class="form-group">
                <button
                    type="button"
                    class="btn btn-danger"
                    data-toggle="modal"
                    data-target="#acercaDe">
                    Acerca del Sitio
                </button>
            </div>
        </div>
    </body>
</html>

<div class="modal fade" id="acercaDe"
     tabindex="-1" role="dialog"
     aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"
                    id="favoritesModalLabel">Desarrollado por:</h4>
            </div>
            <div class="modal-body">
                <p>
                    <br>
                    Juan Maury Rojas: <br style="color:#000000";>jcmauryr@gmail.com</br>
                    <br>
                    Manuel Zuleta Bernal: <br style="color:#000000";>manuelzuletab@gmail.com</br>
                    <br>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-primary"
                        data-dismiss="modal">Cerrar</button>
                <span class="pull-right">

        </span>
            </div>
        </div>
    </div>
</div>

