<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{asset('/css/index.css')}}">
@include('navbar.navbar')
<form method="POST" action="{{ route('ingresarFormulario') }}">
    {{ csrf_field() }}

<div class="col-md-4 mb-3">
    <p align="left">Nombre Empresa <input type="search"
                                          name="nombreEmpresa"
                                          class="form-control"
                                          id="nombreEmpresa"
                                          placeholder="Ingrese Nombre Empresa"
        ></p>

</div>

<div class="col-md-4 mb-3">
    <p align="left">Rut Empresa <input type="search"
                                       name="rutEmpresa"
                                       class="form-control"
                                       id="rutEmpresa"
                                       placeholder="Ingrese Rut Empresa"
        ></p>

</div>

<div class="col-md-4 mb-3">
    <p align="left">Giro <input type="search"
                                        name="queOfrece"
                                        class="form-control"
                                        id="queOfrece"
                                        placeholder="Categoría (Por ejemplo: Educación)"
        ></p>

</div>

<div class="col-md-4 mb-3">
    <p align="left">Dirección de Calle <input type="search"
                                              name="calle"
                                              class="form-control"
                                              id="calle"
                                              placeholder="Por Ejemplo: Blumel 1552"
        ></p>

</div>


<div class="col-md-4 mb-3">
    <p align="left">Comuna <input type="search"
                                  name="comuna"
                                  class="form-control"
                                  id="comuna"
                                  placeholder="Ingrese Comuna. Por Ejemplo: Antofagasta"
        ></p>

</div>


<div class="col-md-4 mb-3">
    <p align="left">Horario de Atención <input type="search"
                                               name="horario"
                                               class="form-control"
                                               id="horario"
                                               placeholder="Por ejemplo: 9:00 a 15:00"
        ></p>

</div>



<div class="col-md-4 mb-3">
    <p align="left">¿Formalizado? <select
            id="formalizado"
            name="formalizado"
            class="form-control"
            required>

            <option value="Si">Si</option>
            <option value="No">No</option>
        </select></p>

</div>



<div class="col-md-4 mb-3">
    <p align="left">Representante <input type="search"
                                    name="contacto"
                                    class="form-control"
                                    id="contacto"
                                    placeholder="Ingrese un Contacto. Por Ejemplo: Juan Pérez"
        ></p>

</div>

<div class="col-md-4 mb-3">
    <p align="left">Teléfono <input type="search"
                                    name="telefono"
                                    class="form-control"
                                    id="telefono"
                                    placeholder="Ingrese un Teléfono"
        ></p>

</div>

<div class="col-md-4 mb-3">
    <p align="left">Email <input type="search"
                                 name="email"
                                 class="form-control"
                                 id="email"
                                 placeholder="Ingrese un Email"
        ></p>

</div>

<div class="col-md-4 mb-3">
    <p align="left">(Opcional) Página de Facebook <input type="search"
                                                         name="facebook"
                                                         class="form-control"
                                                         id="facebook"
                                                         placeholder="Ingrese Link de Facebook Oficial"
        ></p>

</div>

<div class="col-md-4 mb-3">
    <p align="left">(Opcional) Página de Instagram <input type="search"
                                                          name="instagram"
                                                          class="form-control"
                                                          id="instagram"
                                                          placeholder="Ingrese Link de Instagram Oficial"
        ></p>

</div>

<div class="col-md-4 mb-3">
    <p align="left">Descripcion <input type="search"
                                       name="descripcion"
                                       class="form-control"
                                       id="descripcion"
                                       placeholder="Descripción de la Empresa"
        ></p>

</div>

<div class="form-group mt-4">
    <button type="submit" class="btn btn-primary">
        {{ __('Ingresar Datos') }}
    </button>
</div>

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
