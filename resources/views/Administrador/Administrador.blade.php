
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Solicitudes Pendientes<td>
                    <a href="/Administrador/Aprobados" class="btn btn-primary">
                        <input type = "submit" value = "Editar Formularios Aprobados">
                    </a>
                </td></h2>

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
                <th scope="col">Ver Detalles</th>
                <th scope="col">Editar</th>
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
                        <a href="/Administrador/rechazar/{{$formulario->id}}" class="btn btn-primary">
                            <input type = "submit" value = "Rechazar">
                        </a>
                    </td>
                    <td>
                        <a href="/Administrador/detalles/{{$formulario->id}}" class="btn btn-primary">
                            <input type = "submit" value = "Ver Detalles">
                        </a>
                    </td>
                    <td>
                        <a href="/Administrador/editar/{{$formulario->id}}" class="btn btn-primary">
                            <input type = "submit" value = "Editar">
                        </a>
                    </td>
                </tr>

                </tr>
                </tr>
            @endforeach
        </table>

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





