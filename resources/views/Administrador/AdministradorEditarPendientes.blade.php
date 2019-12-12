<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{asset('/css/index.css')}}">
@include('navbar.navbar')
<form method="POST" action="{{ route('actualizarFormularioPendiente') }}">
    {{ csrf_field() }}

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Solicitudes Pendientes
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">
                            <a href=" {{route('actualizarFormularioPendiente')}} " class="btn btn-primary"> Regresar </a>
                        </button>

                    </div></h2>
            </div>

            <table class="table table-striped table-sm">
                <thead class="thead-dark">

                </thead>

                @foreach($formularios as $formulario)
                    <tr>

                        <div class="col-md-4 mb-3">
                            <p align="left">Nombre Empresa</p>
                            <input type="search"
                                   name="nombreEmpresa"
                                   class="form-control"
                                   id="nombreEmpresa"
                                   placeholder="{!! $formulario->nombre_empresa !!}"
                            >
                        </div>


                        <div class="col-md-4 mb-3">
                            <p align="left">Rut Empresa</p>
                            <input type="search"
                                   name="rutEmpresa"
                                   class="form-control"
                                   id="rutEmpresa"
                                   placeholder="{!! $formulario->rut_empresa !!}"
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <p align="left">Giro</p>
                            <input type="search"
                                   name="queOfrece"
                                   class="form-control"
                                   id="queOfrece"
                                   placeholder="{!! $formulario->categoria !!}"
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <p align="left">Ubicación</p>
                            <input type="search"
                                   name="calle"
                                   class="form-control"
                                   id="calle"
                                   placeholder="{!! $formulario->ubicacion !!}"
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <p align="left">Horario</p>
                            <input type="search"
                                   name="horario"
                                   class="form-control"
                                   id="horario"
                                   placeholder="{!! $formulario->horario !!}"
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <p align="left">Facebook</p>
                            <input type="search"
                                   name="facebook"
                                   class="form-control"
                                   id="facebook"
                                   placeholder="{!! $formulario->facebook !!}"
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <p align="left">Instagram</p>
                            <input type="search"
                                   name="instagram"
                                   class="form-control"
                                   id="instagram"
                                   placeholder="{!! $formulario->instagram !!}"
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <p align="left">¿Formalizado?</p>
                            <select
                                id="formalizado"
                                name="formalizado"
                                class="form-control"
                                required>

                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <p align="left">Comuna</p>
                            <input type="search"
                                   name="comuna"
                                   class="form-control"
                                   id="comuna"
                                   placeholder="{!! $formulario->comuna !!}"
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <p align="left">Contacto</p>
                            <input type="search"
                                   name="contacto"
                                   class="form-control"
                                   id="contacto"
                                   placeholder="{!! $formulario->contacto !!}"
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <p align="left">Teléfono</p>
                            <input type="search"
                                   name="telefono"
                                   class="form-control"
                                   id="telefono"
                                   placeholder="{!! $formulario->telefono !!}"
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <p align="left">Correo</p>
                            <input type="search"
                                   name="email"
                                   class="form-control"
                                   id="email"
                                   placeholder="{!! $formulario->mail !!}"
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <p align="left">Descripción</p>
                            <input type="search"
                                   name="descripcion"
                                   class="form-control"
                                   id="descripcion"
                                   placeholder="{!! $formulario->descripcion !!}"
                            >
                        </div>

                        <input type="hidden" value="{{ $formulario->id }}" name="idEmpresa">

                    </tr>

                @endforeach
            </table>

        </div>
    </div>

    <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Actualizar Datos', compact($formulario->id)) }}
        </button>
    </div>

    @if ($message = Session::get('exito1'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
@endif


