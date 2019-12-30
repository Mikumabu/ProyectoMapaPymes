<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{asset('/css/index.css')}}">
@include('navbar.navbar')
<form method="POST" action="{{ route('actualizarFormularioAprobado') }}">
    {{ csrf_field() }}
    <div class="form-row justify-content-center">
        <input type="hidden" value="{{ $formularios->id }}" name="idEmpresa">
        <div class="col-md-3">
            <div class="form-group">
                <p align="left">Nombre Empresa <input type="search"
                                                      name="nombreEmpresa"
                                                      class="form-control"
                                                      id="nombreEmpresa"
                                                      value="{{$formularios->nombre_empresa}}">
                </p>
                <small class="text-danger">{{ $errors->first('nombreEmpresa') }}</small>
            </div>
            <div class="form-group">
                <p align="left">Rut Empresa <input type="search"
                                                   name="rutEmpresa"
                                                   class="form-control"
                                                   id="rutEmpresa"
                                                   value="{{$formularios->rut_empresa}}">
                </p>
                <small class="text-danger">{{ $errors->first('rutEmpresa') }}</small>
            </div>

            <div class="form-group">
                <p align="left">Giro <select
                        id="queOfrece"
                        name="queOfrece"
                        class="form-control"
                        required>

                        <option value="Agricultura, ganadería, silvicultura y pesca">Agricultura, ganadería, silvicultura y pesca</option>
                        <option value="Explotación de minas y canteras">Explotación de minas y canteras</option>
                        <option value="Industria manufacturera">Industria manufacturera</option>
                        <option value="Suministro de electricidad, gas, vapor y aire acondicionado">Suministro de electricidad, gas, vapor y aire acondicionado</option>
                        <option value="Suministro de agua; evacuación de aguas residuales, gestión de desechos y descontaminación">Suministro de agua; evacuación de aguas residuales, gestión de desechos y descontaminación</option>
                        <option value="Construcción">Construcción</option>
                        <option value="Comercio al por mayor y al por menor; reparación de vehiculos automotores y motocicletas">Comercio al por mayor y al por menor; reparación de vehiculos automotores y motocicletas</option>
                        <option value="Transporte y almacenamiento">Transporte y almacenamiento</option>
                        <option value="Actividades de alojamiento y de servicio de comidas">Actividades de alojamiento y de servicio de comidas</option>
                        <option value="Información y comunicaciones">Información y comunicaciones</option>
                        <option value="Actividades financieras y de seguros">Actividades financieras y de seguros</option>
                        <option value="Actividades inmobiliarias">Actividades inmobiliarias</option>
                        <option value="Actividades profesionales, cientificas y técnicas">Actividades profesionales, cientificas y técnicas</option>
                        <option value="Actividades de servicios administrativos y de apoyo">Actividades de servicios administrativos y de apoyo</option>
                        <option value="Administración pública y defensa; planes de seguridad social de afiliación obligatoria">Administración pública y defensa; planes de seguridad social de afiliación obligatoria</option>
                        <option value="Enseñanza">Enseñanza</option>
                        <option value="Actividades de atención de la salud humana y de asistencia social">Actividades de atención de la salud humana y de asistencia social</option>
                        <option value="Actividades artísticas, de entretenimiento y recreativas">Actividades artísticas, de entretenimiento y recreativas</option>
                        <option value="Otras actividades de servicios">Otras actividades de servicios</option>


                    </select></p>
                <small class="text-danger">{{ $errors->first('queOfrece') }}</small>
            </div>


            <div class="form-group">
                <p align="left">(Opcional) Página de Facebook <input type="search"
                                                                     name="facebook"
                                                                     class="form-control"
                                                                     id="facebook"
                                                                     value="{{$formularios->facebook}}">
                </p>
                <small class="text-danger">{{ $errors->first('facebook') }}</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <p align="left">Dirección <input type="search"
                                                 name="calle"
                                                 class="form-control"
                                                 id="calle"
                                                 value="{{$formularios->ubicacion}}">
                </p>
                <small class="text-danger">{{ $errors->first('calle') }}</small>
            </div>
            <div class="form-group">
                <p align="left">Comuna <input type="search"
                                              name="comuna"
                                              class="form-control"
                                              id="comuna"
                                              value="{{$formularios->comuna}}">
                </p>
                <small class="text-danger">{{ $errors->first('comuna') }}</small>
            </div>
            <div class="form-group">
                <p align="left">Horario de Atención <input type="search"
                                                           name="horario"
                                                           class="form-control"
                                                           id="horario"
                                                           value="{{$formularios->horario}}">
                </p>
                <small class="text-danger">{{ $errors->first('horario') }}</small>
            </div>
            <div class="form-group">
                <p align="left">(Opcional) Página de Instagram <input type="search"
                                                                      name="instagram"
                                                                      class="form-control"
                                                                      id="instagram"
                                                                      value="{{$formularios->instagram}}">
                </p>
                <small class="text-danger">{{ $errors->first('instagram') }}</small>
            </div>
            <div class="form-group">
                <p align="left">¿Formalizado? <select
                            id="formalizado"
                            name="formalizado"
                            class="form-control"
                            required>
                        @if($formularios->formalizado == "Si"){
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                        }
                        @else
                            <option value="Si">Si</option>
                            <option value="No" selected>No</option>
                        @endif
                    </select></p>
                <small class="text-danger">{{ $errors->first('formalizado') }}</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <p align="left">Representante <input type="search"
                                                     name="contacto"
                                                     class="form-control"
                                                     id="contacto"
                                                     value="{{$formularios->contacto}}">
                </p>
                <small class="text-danger">{{ $errors->first('contacto') }}</small>
            </div>
            <div class="form-group">
                <p align="left">Teléfono <input type="search"
                                                name="telefono"
                                                class="form-control"
                                                id="telefono"
                                                value="{{$formularios->telefono}}">
                </p>
                <small class="text-danger">{{ $errors->first('telefono') }}</small>
            </div>
            <div class="form-group">
                <p align="left">Email <input type="search"
                                             name="email"
                                             class="form-control"
                                             id="email"
                                             value="{{$formularios->mail}}">
                </p>
                <small class="text-danger">{{ $errors->first('email') }}</small>
            </div>
            <div class="form-group">
                <p align="left">(Opcional) Otro sitio web <input type="search"
                                                                 name="url"
                                                                 class="form-control"
                                                                 id="url"
                                                                 value="{{$formularios->url}}">
                </p>
                <small class="text-danger">{{ $errors->first('url') }}</small>
            </div>
        </div>
    </div>
    <div class="form-row justify-content-center">
        <div class="col-md-4">
            <div class="form-group">
                <p align="left">Descripción de la empresa <textarea
                            name="descripcion"
                            class="form-control"
                            id="descripcion"
                            maxlength="300"
                            style="width:100%; height:200px;"
                    >{{$formularios->descripcion}}</textarea></p>
                <div id="textarea_feedback"></div>
                <small class="text-danger">{{ $errors->first('descripcion') }}</small>
            </div>
        </div>
    </div>

    <div class="form-group">
        Por último, confirme la dirección de su empresa en el mapa
        <br>
    </div>
    <div id="map">
        {!! Mapper::render(0) !!}
    </div>
    <input type="hidden" name="latitud" id="latitud" value="{{$formularios->latitud}}">
    <input type="hidden" name="longitud" id="longitud" value="{{$formularios->longitud}}">
    <div>
        <br>
    </div>
    <div class="form-row justify-content-center">
        <div class="col-md-3">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('Actualizar Datos', compact($formularios->id)) }}
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

<script>
    $(document).ready(function() {
        var text_max = 300;
        $('#textarea_feedback').html(text_max+'/'+text_max);

        $('#descripcion').keyup(function() {
            var text_length = $('#descripcion').val().length;
            var text_remaining = text_max - text_length;

            $('#textarea_feedback').html(text_remaining+'/'+text_max);
        });
    });
</script>
