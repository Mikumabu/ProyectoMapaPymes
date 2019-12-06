
<form method="POST" action="{{ route('ingresarFormulario') }}">
    {{ csrf_field() }}

<div class="col-md-4 mb-3">
    <p align="left">Nombre Empresa</p>
    <input type="search"
           name="nombreEmpresa"
           class="form-control"
           id="nombreEmpresa"
           placeholder="Ingrese Nombre Empresa"
    >
</div>

<div class="col-md-4 mb-3">
    <p align="left">Rut Empresa</p>
    <input type="search"
           name="rutEmpresa"
           class="form-control"
           id="rutEmpresa"
           placeholder="Ingrese Rut Empresa"
    >
</div>

<div class="col-md-4 mb-3">
    <p align="left">¿Qué Ofrece?</p>
    <input type="search"
           name="queOfrece"
           class="form-control"
           id="queOfrece"
           placeholder="Categoría (Por ejemplo: Educación)"
    >
</div>

<div class="col-md-4 mb-3">
    <p align="left">Ubicación de Calle</p>
    <input type="search"
           name="calle"
           class="form-control"
           id="calle"
           placeholder="Por Ejemplo: Blumel 1552"
    >
</div>

<div class="col-md-4 mb-3">
    <p align="left">Horario de Atención</p>
    <input type="search"
           name="horario"
           class="form-control"
           id="horario"
           placeholder="Por ejemplo: 9:00 a 15:00"
    >
</div>

<div class="col-md-4 mb-3">
    <p align="left">(Opcional) Página de Facebook</p>
    <input type="search"
           name="facebook"
           class="form-control"
           id="facebook"
           placeholder="Ingrese Link de Facebook Oficial"
    >
</div>

<div class="col-md-4 mb-3">
    <p align="left">(Opcional) Página de Instagram</p>
    <input type="search"
           name="instagram"
           class="form-control"
           id="instagram"
           placeholder="Ingrese Link de Instagram Oficial"
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
           placeholder="Ingrese Comuna. Por Ejemplo: Antofagasta"
    >
</div>

<div class="col-md-4 mb-3">
    <p align="left">Contacto</p>
    <input type="search"
           name="contacto"
           class="form-control"
           id="contacto"
           placeholder="Ingrese un Contacto. Por Ejemplo: Juan Pérez"
    >
</div>

<div class="col-md-4 mb-3">
    <p align="left">Teléfono</p>
    <input type="search"
           name="telefono"
           class="form-control"
           id="telefono"
           placeholder="Ingrese un Teléfono"
    >
</div>

<div class="col-md-4 mb-3">
    <p align="left">Email</p>
    <input type="search"
           name="email"
           class="form-control"
           id="email"
           placeholder="Ingrese un Email"
    >
</div>

<div class="col-md-4 mb-3">
    <p align="left">Descripcion</p>
    <input type="search"
           name="descripcion"
           class="form-control"
           id="descripcion"
           placeholder="Descripción de la Empresa"
    >
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
