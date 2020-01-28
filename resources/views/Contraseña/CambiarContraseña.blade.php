<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!--<meta name="csrf-token" content="{ csrf_token() }}">-->
<link rel="stylesheet" href="{{asset('/css/index.css')}}">
@include('navbar.navbar')

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

@if ($message = Session::get('error3'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('exito1'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>* Se ha enviado un Código Verificador a su Correo</strong>
</div>
<div>
    <br>
</div>

<form method="POST" action="{{ route('nuevaContraseña') }}" enctype="multipart/form-data" id="form-id">
    {{ csrf_field() }}

    <div class="form-row justify-content-center">
        <div class="col-md-3">
            <div class="form-group">
                <p align="left">Código Verificador <input type="search"
                                                          name="codigo"
                                                          class="form-control"
                                                          id="codigo"
                                                          placeholder="Ingrese el Código">
                </p>
                <small id="error" class="contacto text-danger"></small>
            </div>
        </div>
    </div>

    <div class="form-row justify-content-center">
        <div class="col-md-3">
            <div class="form-group">
                <p align="left">Nueva Contraseña <input type="password"
                                                          name="contraseña"
                                                          class="form-control"
                                                          id="contraseña"
                                                          placeholder="Ingrese su Nueva Contraseña">
                </p>
                <small id="error" class="contacto text-danger"></small>
            </div>
        </div>
    </div>

    <div class="form-row justify-content-center">
        <div class="col-md-3">
            <div class="form-group">
                <p align="left">Confirmar Nueva Contraseña <input type="password"
                                                          name="contraseñaConfirmar"
                                                          class="form-control"
                                                          id="contraseñaConfirmar"
                                                          placeholder="Ingrese nuevamente Nueva Contraseña">
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


