<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!--<meta name="csrf-token" content="{ csrf_token() }}">-->
<link rel="stylesheet" href="{{asset('/css/index.css')}}">
@include('navbar.navbar')
<div>
    <br>
</div>

<form method="POST" action="{{ route('nuevoAdministrador') }}" enctype="multipart/form-data" id="form-id">
    {{ csrf_field() }}

    <div class="form-row justify-content-center">
        <div class="col-md-3">
            <div class="form-group">
                <p align="left">Nombre Completo <input type="search"
                                                          name="nombre"
                                                          class="form-control"
                                                          id="nombre"
                                                          placeholder="Ingrese Nombre Completo">
                </p>
                <small id="error" class="contacto text-danger"></small>
            </div>
        </div>
    </div>

    <div class="form-row justify-content-center">
        <div class="col-md-3">
            <div class="form-group">
                <p align="left">Correo Electrónico <input type="search"
                                                          name="correo"
                                                          class="form-control"
                                                          id="correo"
                                                          placeholder="Ingrese su Correo Electrónico">
                </p>
                <small id="error" class="contacto text-danger"></small>
            </div>
        </div>
    </div>


    <div class="form-row justify-content-center">
        <div class="col-md-3">
            <div class="form-group">
                <p align="left">Contraseña <input type="password"
                                                        name="contraseña"
                                                        class="form-control"
                                                        id="contraseña"
                                                        placeholder="Ingrese una Contraseña">
                </p>
                <small id="error" class="contacto text-danger"></small>
            </div>
        </div>
    </div>

    <div class="form-row justify-content-center">
        <div class="col-md-3">
            <div class="form-group">
                <p align="left">Confirmar Contraseña <input type="password"
                                                                  name="contraseñaConfirmar"
                                                                  class="form-control"
                                                                  id="contraseñaConfirmar"
                                                                  placeholder="Confirme la Contraseña">
                </p>
                <small id="error" class="contacto text-danger"></small>
            </div>
        </div>
    </div>

    <div class="form-row justify-content-center">
        <div class="col-md-3">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('Ingresar') }}
                </button>
            </div>
        </div>
    </div>
</form>

@if ($message = Session::get('exito1'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error1'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error2'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
