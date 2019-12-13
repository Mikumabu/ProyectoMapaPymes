<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
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
        <div class="container col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Solicitudes Pendientes
                        <td>
                            <a href="/Administrador/Aprobados" class="btn btn-primary">
                                <input type = "submit" value = "Editar Formularios Aprobados">
                            </a>
                        </td>
                    </h2>
                </div>
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre Empresa</th>
                            <th scope="col">Rut Empresa</th>
                            <th scope="col">¿Qué Ofrece?</th>
                            <th scope="col">¿Formalizado?</th>
                            <th scope="col">Comuna</th>
                            <th scope="col">Aceptar</th>
                            <th scope="col">Rechazar</th>
                            <th scope="col">Ver Detalles/Editar</th>

                        </tr>
                    </thead>
                    @foreach($formularios as $formulario)
                        <tr>
                            <th scope="row">{!! $formulario->id !!}</th>
                            <th scope="row">{!! $formulario->nombre_empresa !!}</th>
                            <td scope="row">{!! $formulario->rut_empresa !!}</td>
                            <td scope="row">{!! $formulario->categoria !!}</td>
                            <td scope="row">{!! $formulario->formalizado !!}</td>
                            <td scope="row">{!! $formulario->comuna !!}</td>
                            <td>
                                <a href="/Administrador/aceptar/{{$formulario->id}}" class="btn btn-primary">
                                    <input type = "submit" value = "Aceptar">
                                </a>
                            </td>
                            <td>
                                <a href="/Administrador/eliminar/{{$formulario->id}}" class="btn btn-primary">
                                    <input type = "submit" value = "Rechazar">
                                </a>
                            </td>

                            <td>
                                <a href="/Administrador/editar/{{$formulario->id}}" class="btn btn-primary">
                                    <input type = "submit" value = "Ver Detalles/Editar">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="modal fade" id="detalles" style="width: 750px; margin: 100px auto; min-width: 1200px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span>×</span>
                        </button>
                        <h4>Detalles</h4>
                    </div>
                    <div class="modal-body" >

                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Ubicación</th>
                                <th scope="col">Horario</th>
                                <th scope="col">Facebook</th>
                                <th scope="col">Instagram</th>
                                <th scope="col">Contacto</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Descripción</th>

                            </tr>
                            </thead>
                            @foreach($formularios as $formulario)
                                <tr>
                                    <td scope="row">{!! $formulario->ubicacion !!}</td>
                                    <td scope="row">{!! $formulario->horario !!}</td>
                                    <td scope="row">{!! $formulario->facebook !!}</td>
                                    <td scope="row">{!! $formulario->instagram !!}</td>
                                    <td scope="row">{!! $formulario->contacto !!}</td>
                                    <td scope="row">{!! $formulario->telefono !!}</td>
                                    <td scope="row">{!! $formulario->mail !!}</td>
                                    <td scope="row">{!! $formulario->descripcion !!}</td>

                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
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
    </body>
</html>
