<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

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
        @if ($message = Session::get('exito2'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if ($message = Session::get('exito3'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="container col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Solicitudes Pendientes
                    </h2>

                    <td>
                        <a href="/Administrador/Aprobados" class="btn btn-primary">
                            Editar Formularios Aprobados
                        </a>
                        <a href="/Administrador/PalabrasProhibidas" class="btn btn-primary">
                            Agregar Palabras Prohibidas
                        </a>
                        <a href="/Administrador/HistorialRechazados" class="btn btn-primary">
                            Historial Rechazados
                        </a>
                    </td>

                </div>
                <div>
                    <br>
                </div>
                <input class="form-control" id="myInput" type="text" placeholder="Busque por rut, nombre, etc...">
                <div>
                    <br>
                </div>
                <table id="tablaEmprendedores" class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"><button type="button" name="bulk_accept" id="bulk_accept" class="btn btn-success btn-xs">Y</button><button type="button" name="bulk_delete" id="bulk_delete" class="btn btn-danger btn-xs">X</button></th>
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
                        @foreach($formularios as $formulario)
                            <tr>
                                <th><input type="checkbox" value="{!! $formulario->id !!}" name="emprendedor[]" class="emprendedor"></th>
                                <th scope="row">{!! $formulario->id !!}</th>
                                <th scope="row">{!! $formulario->nombre_empresa !!}</th>
                                <td scope="row">{!! $formulario->rut_empresa !!}</td>
                                <td scope="row">{!! $formulario->categoria !!}</td>
                                <td scope="row">{!! $formulario->formalizado !!}</td>
                                <td scope="row">{!! $formulario->comuna !!}</td>
                                <td class="col-sm">
                                    <a href="/Administrador/aceptar/{{$formulario->id}}" class="btn btn-success">
                                        Aceptar
                                    </a>
                                    <a href="/Administrador/rechazar/{{$formulario->id}}" class="btn btn-danger">
                                        Rechazar
                                    </a>
                                    <a href="/Administrador/editar/{{$formulario->id}}" class="btn btn-primary">
                                        Detalles/Editar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        $(document).on('click', '#bulk_delete', function(){
            var id = [];
            {
                $('.emprendedor:checked').each(function(){
                    id.push($(this).val());
                });
                if(id.length > 0)
                {
                    $.ajax({
                        url:"Administrador/rechazarMasa",
                        method:"GET",
                        data:{id:id},
                        success:function(data)
                        {
                            window.location.reload();
                        },
                    });
                }
            }
        });
        $(document).on('click', '#bulk_accept', function(){
            var id = [];
            {
                $('.emprendedor:checked').each(function(){
                    id.push($(this).val());
                });
                if(id.length > 0)
                {
                    $.ajax({
                        url:"Administrador/aceptarMasa",
                        method:"GET",
                        data:{id:id},
                        success:function(data)
                        {
                            window.location.reload();
                        },
                    });
                }
            }
        });
    </script>
</html>
