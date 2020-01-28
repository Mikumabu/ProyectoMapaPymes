<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{asset('/css/index.css')}}">
@include('navbar.navbar')

@if ($message = Session::get('exito1'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('exito2'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

<div>
    <br>
</div>

<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Historial de Solicitudes Rechazadas
                <div class="form-group mt-4 float-right">
                    <button type="submit" class="btn btn-primary">
                        <a href=" {{route('actualizarFormularioPendiente')}} " class="btn btn-primary"> Regresar </a>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <a href=" {{route('borrarHistorial')}} " class="btn btn-primary"> Borrar Historial </a>
                    </button>

                </div></h2>
        </div>
        <div>
            <br>
        </div>
        <input class="form-control" id="myInput" type="text" placeholder="Busque por rut, nombre, etc...">
        <div>
            <br>
        </div>
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Empresa</th>
                <th scope="col">Rut Empresa</th>
                <th scope="col">Giro</th>
                <th scope="col">¿Formalizado?</th>
                <th scope="col">Comuna</th>
                <th scope="col">Opciones</th>

            </tr>
            </thead>
            <tbody id="myTable">
            @foreach($historial_rechazados as $rechazado)
                <tr>
                    <th scope="row">{!! $rechazado->id !!}</th>
                    <th scope="row">{!! $rechazado->nombre_empresa !!}</th>
                    <td scope="row">{!! $rechazado->rut_empresa !!}</td>
                    <td scope="row">{!! $rechazado->categoria !!}</td>
                    <td scope="row">{!! $rechazado->formalizado !!}</td>
                    <td scope="row">{!! $rechazado->comuna !!}</td>
                    <td>

                        <a href="/Administrador/recuperar/{{$rechazado->id}}" class="btn btn-danger">
                            Recuperar
                        </a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>


<script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
