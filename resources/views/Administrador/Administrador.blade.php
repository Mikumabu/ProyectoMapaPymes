
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Solicitudes Pendientes</h2>
        </div>

        <table class="table table-striped table-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre Empresa</th>
                <th scope="col">Rut Empresa</th>
                <th scope="col">¿Qué Ofrece?</th>
                <th scope="col">Ubicación de Calle</th>
                <th scope="col">Horario de Atención</th>
                <th scope="col">¿Formalizado?</th>
                <th scope="col">Comuna</th>
                <th scope="col">Contacto</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Email</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Aceptar</th>
                <th scope="col">Rechazar</th>
                <th scope="col">Editar</th>
                <th scope="col">Ver Detalles</th>
            </tr>
            </thead>

            @foreach($formularios as $formulario)
                <tr>
                    <th scope="row">{!! $formulario->id !!}</th>
                    <th scope="row">{!! $formulario->nombre_empresa !!}</th>
                    <td scope="row">{!! $formulario->rut_empresa !!}</td>
                    <td scope="row">{!! $formulario->categoria !!}</td>
                    <td scope="row">{!! $formulario->ubicacion !!}</td>
                    <td scope="row">{!! $formulario->horario !!}</td>
                    <td scope="row">{!! $formulario->formalizado !!}</td>
                    <td scope="row">{!! $formulario->comuna !!}</td>
                    <td scope="row">{!! $formulario->contacto !!}</td>
                    <td scope="row">{!! $formulario->telefono !!}</td>
                    <td scope="row">{!! $formulario->mail !!}</td>
                    <td scope="row">{!! $formulario->descripcion !!}</td>
                    <td width="10px">
                        <a href="#" class="btn btn-warning btn-sm">Aceptar</a>
                    </td>
                    <td width="10px">
                        <a href="#" class="btn btn-warning btn-sm">Rechazar</a>
                    </td>
                    <td width="10px">
                        <a href="#" class="btn btn-warning btn-sm">Editar</a>
                    </td>
                    <td width="10px">
                        <a href="#" class="btn btn-warning btn-sm">Ver Detalles</a>
                    </td>
                </tr>
                </tr>
            @endforeach
        </table>

    </div>
</div>

<form method="POST" action="{{ route('aceptarFormulario') }}">
    {{ csrf_field() }}

    <div class="col-md-4 mb-3">
        <p align="left">Ingrese ID de Formulario a Aceptar</p>
        <input type="search"
               name="idAceptar"
               class="form-control"
               id="idAceptar"
               placeholder="Ingrese ID"
        >
    </div>

    <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Aceptar Registro') }}
        </button>
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





