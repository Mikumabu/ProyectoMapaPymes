<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
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

        <form method="POST" action="{{ route('filtrar') }}">
            {{ csrf_field() }}

        <?php
            $datos = DB::table('formularios_aprobados')->select('categoria')->distinct()->get();
        ?>

        <div class="col-md-4 mb-3">
            <p align="left">Filtrar por Categoría <select
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
                </select></p>

        </div>



            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Buscar') }}
                </button>
            </div>

        <div>
            <br>
        </div>
        <div id="map">
            {!! Mapper::render(0) !!}
        </div>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIuJCrwX-2-hqArtpPyTEn340ezoucpS4&callback=initMap"
                async defer></script>
    </body>
</html>

<script>
    $("#mySelect").change(function myFunction() {
        var tr, element, table, colCurso, txtValue;
        element = (document.getElementById("mySelect")).value;
        table = document.getElementById("tabla");
        tr = table.getElementsByTagName("tr");

        for(i = 0; i<tr.length; i++){
            colCurso = tr[i].getElementsByTagName(tr[3]);
            if (colCurso) {
                txtValue = colCurso.textContent || colCurso.innerText;
                if ((txtValue.toUpperCase().indexOf(element) > -1)){
                    // Checkeo Fecha

                    tr[i].style.display = "";
                }
                else {
                    tr[i].style.display = "none";
                }
            }
        }
    });
</script>
