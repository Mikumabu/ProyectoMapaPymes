<link rel="stylesheet" href="{{asset('/css/index.css')}}">
@include('navbar.navbar')
<form method="POST" action="{{ route('actualizarFormularioAprobado') }}">
    {{ csrf_field() }}

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Solicitudes Aprobadas
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">
                            <a href=" {{route('actualizarFormularioPendiente')}} " class="btn btn-primary"> Regresar </a>
                        </button>

                    </div></h2>
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
                    <th scope="col">Facebook</th>
                    <th scope="col">Instagram</th>
                    <th scope="col">¿Formalizado?</th>
                    <th scope="col">Comuna</th>
                    <th scope="col">Contacto</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Descripcion</th>

                </tr>
                </thead>

                @foreach($formularios_aprobados as $formulario_aprobado)
                    <tr>
                        <th scope="row" id="idEmpresa">{!! $formulario_aprobado->id !!}</th>

                        <th scope="row" id="nombreEmpresa">{!! $formulario_aprobado->nombre_empresa !!}</th>

                        <td scope="row" id="rutEmpresa">{!! $formulario_aprobado->rut_empresa !!}</td>

                        <td <div class="col-md-4 mb-3">
                            <input type="search"
                                   name="queOfrece"
                                   class="form-control"
                                   id="queOfrece"
                                   placeholder="{!! $formulario_aprobado->categoria !!}"
                            >
                        </div></td>

                        <td <div class="col-md-4 mb-3">
                            <input type="search"
                                   name="calle"
                                   class="form-control"
                                   id="calle"
                                   placeholder="{!! $formulario_aprobado->ubicacion !!}"
                            >
                        </div></td>

                        <td <div class="col-md-4 mb-3">
                            <input type="search"
                                   name="horario"
                                   class="form-control"
                                   id="horario"
                                   placeholder="{!! $formulario_aprobado->horario !!}"
                            >
                        </div></td>

                        <td <div class="col-md-4 mb-3">
                            <input type="search"
                                   name="facebook"
                                   class="form-control"
                                   id="facebook"
                                   placeholder="{!! $formulario_aprobado->facebook !!}"
                            >
                        </div></td>

                        <td <div class="col-md-4 mb-3">
                            <input type="search"
                                   name="instagram"
                                   class="form-control"
                                   id="instagram"
                                   placeholder="{!! $formulario_aprobado->instagram !!}"
                            >
                        </div></td>

                        <td <div class="col-md-4 mb-3">
                            <select
                                id="formalizado"
                                name="formalizado"
                                class="form-control"
                                required>

                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div></td>

                        <td <div class="col-md-4 mb-3">
                            <input type="search"
                                   name="comuna"
                                   class="form-control"
                                   id="comuna"
                                   placeholder="{!! $formulario_aprobado->comuna !!}"
                            >
                        </div></td>
                        <td <div class="col-md-4 mb-3">
                            <input type="search"
                                   name="contacto"
                                   class="form-control"
                                   id="contacto"
                                   placeholder="{!! $formulario_aprobado->contacto !!}"
                            >
                        </div></td>

                        <td <div class="col-md-4 mb-3">
                            <input type="search"
                                   name="telefono"
                                   class="form-control"
                                   id="telefono"
                                   placeholder="{!! $formulario_aprobado->telefono !!}"
                            >
                        </div></td>

                        <td <div class="col-md-4 mb-3">
                            <input type="search"
                                   name="email"
                                   class="form-control"
                                   id="email"
                                   placeholder="{!! $formulario_aprobado->mail !!}"
                            >
                        </div></td>

                        <td <div class="col-md-4 mb-3">
                            <input type="search"
                                   name="descripcion"
                                   class="form-control"
                                   id="descripcion"
                                   placeholder="{!! $formulario_aprobado->descripcion !!}"
                            >
                        </div></td>

                        <input type="hidden" value="{{ $formulario_aprobado->id }}" name="idEmpresa">
                        <input type="hidden" value="{{ $formulario_aprobado->nombre_empresa }}" name="nombreEmpresa">
                        <input type="hidden" value="{{ $formulario_aprobado->rut_empresa }}" name="rutEmpresa">

                    </tr>

                    </tr>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>

    <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Actualizar Datos', compact($formulario_aprobado->id)) }}
        </button>
    </div>

    @if ($message = Session::get('exito1'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
@endif


