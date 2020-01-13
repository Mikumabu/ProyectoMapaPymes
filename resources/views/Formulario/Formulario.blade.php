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
<div class="flash-message"></div>
<form method="POST" action="{{ route('ingresarFormulario') }}" enctype="multipart/form-data" id="form-id">
    {{ csrf_field() }}
    <div class="form-row justify-content-center">
        <div class="col-md-3">
            <div class="md-form">
                <p align="left">Nombre Empresa <input type="text"
                                                      name="nombreEmpresa"
                                                      class="form-control"
                                                      id="nombreEmpresa"
                                                      placeholder="Ingrese Nombre Empresa">
                </p>
                <small id="error" class="nombre text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">Rut Empresa <input type="text"
                                                   name="rutEmpresa"
                                                   class="form-control"
                                                   id="rutEmpresa"
                                                   placeholder="Ingrese Rut Empresa">
                </p>
                <small id="error" class="rut text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">¿Emites factura?
                    <select id="formalizado"
                            name="formalizado"
                            class="form-control"
                            required>

                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select></p>
                <small id="error" class="formalizado text-danger"></small>
            </div>

            <div class="form-group">
                <p align="left">(Opcional) Página de Facebook <input type="text"
                                                                     name="facebook"
                                                                     class="form-control"
                                                                     id="facebook"
                                                                     placeholder="Ingrese Link de Facebook Oficial">
                </p>
                <small id="error" class="facebook text-danger"></small>
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
                    </select>
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <p align="left">Dirección <input type="text"
                                                 name="calle"
                                                 class="form-control"
                                                 id="calle"
                                                 placeholder="Ejemplo: Blumel 1552">
                </p>
                <small id="error" class="calle text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">Comuna <input type="text"
                                              name="comuna"
                                              class="form-control"
                                              id="comuna"
                                              placeholder="Ejemplo: Antofagasta">
                </p>
                <small id="error" class="comuna text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">Horario de Atención <input type="text"
                                                          name="horario"
                                                          class="form-control"
                                                          id="horario"
                                                          placeholder="Ejemplo: 9:00 a 15:00">
                </p>
                <small id="error" class="horario text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">(Opcional) Página de Instagram <input type="text"
                                                                      name="instagram"
                                                                      class="form-control"
                                                                      id="instagram"
                                                                      placeholder="Ingrese Link de Instagram Oficial"
                    ></p>
                <small class="instagram text-danger"></small>
            </div>
            <div class="form-row justify-content-center">
                <div class="col">
                    <div class="form-group">
                        <p align="left">Descripción de la empresa <textarea
                                    name="descripcion"
                                    class="form-control"
                                    id="descripcion"
                                    placeholder="Describa cómo es su empresa"
                                    maxlength="300"
                                    style="width:100%; height:200px;"
                            ></textarea></p>
                        <div id="textarea_feedback"></div>
                        <small id="error" class="descripcion text-danger"></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <p align="left">Representante <input type="text"
                                                     name="contacto"
                                                     class="form-control"
                                                     id="contacto"
                                                     placeholder="Ingrese un Contacto. Por Ejemplo: Juan Pérez">
                </p>
                <small id="error" class="contacto text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">Teléfono <input type="text"
                                                name="telefono"
                                                class="form-control"
                                                id="telefono"
                                                placeholder="Ingrese un Teléfono">
                </p>
                <small id="error" class="telefono text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">Email <input type="text"
                                             name="email"
                                             class="form-control"
                                             id="email"
                                             placeholder="Ingrese un Email">
                </p>
                <small id="error" class="email text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">(Opcional) Otro sitio web <input type="text"
                                                                      name="url"
                                                                      class="form-control"
                                                                      id="url"
                                                                      placeholder="Ingrese Link de web u otra red social"
                    ></p>
                <small id="error" class="url text-danger"></small>
            </div>
            <div class="form-group">
                <label for="archivo">
                    <p align="left">
                        Sube tu imagen o logo:
                    </p>
                </label>
                <input type="file" name="archivo" required>
            </div>
        </div>
    </div>

    <div>
        <br>
    </div>
    <div class="form-row justify-content-center" style="font-size: 20px; color:red;">
        ¡Ya casi! Confirma la dirección de tu Emprendimiento en el mapa.
            <br>
    </div>
    <div>
        <br>
    </div>
    <div id="map">
        {!! Mapper::render(0) !!}
    </div>
    <input type="hidden" name="latitud" id="latitud" value="-23.6">
    <input type="hidden" name="longitud" id="longitud" value="-70.4">
    <div>
        <br>
    </div>

    <div class="form-row justify-content-center">
        <div class="col-md-3">
            <div class="form-group">

                <a class="btn btn-danger" href="#edit"data-toggle="modal">
                    Ingresar Datos
                </a>

                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">¿Está listo para enviar?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</form>






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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".btn-primary").click(function(e){
        e.preventDefault();
        let myForm = document.getElementById('form-id');
        let formData = new FormData(myForm);
        $.ajax({
            type:'POST',
            url:'Formulario',
            data: formData,
            success:function(data) {
                $('#error').html("");
                $('html, body').animate({ scrollTop: 0 }, 0);
                $('div.flash-message').html(data);
                document.getElementById("form-id").reset();
            },
            error: function(data){
                $('html, body').animate({ scrollTop: 0 }, 0);
                $('#error').html("");
                if(data.responseJSON.errors.nombreEmpresa != null){
                    $('.nombre').text(data.responseJSON.errors.nombreEmpresa[0]);
                }
                if(data.responseJSON.errors.rutEmpresa != null){
                    $('.rut').text(data.responseJSON.errors.rutEmpresa[0]);
                }
                if(data.responseJSON.errors.calle != null){
                    $('.calle').text(data.responseJSON.errors.calle[0]);
                }
                if(data.responseJSON.errors.comuna != null){
                    $('.comuna').text(data.responseJSON.errors.comuna[0]);
                }
                if(data.responseJSON.errors.horario != null){
                    $('.horario').text(data.responseJSON.errors.horario[0]);
                }
                if(data.responseJSON.errors.contacto != null){
                    $('.contacto').text(data.responseJSON.errors.contacto[0]);
                }
                if(data.responseJSON.errors.telefono != null){
                    $('.telefono').text(data.responseJSON.errors.telefono[0]);
                }
                if(data.responseJSON.errors.email != null){
                    $('.email').text(data.responseJSON.errors.email[0]);
                }
                if(data.responseJSON.errors.descripcion != null){
                    $('.descripcion').text(data.responseJSON.errors.descripcion[0]);
                }
                if(data.responseJSON.errors.facebook != null){
                    $('.facebook').text(data.responseJSON.errors.facebook[0]);
                }
                if(data.responseJSON.errors.instagram != null){
                    $('.instagram').text(data.responseJSON.errors.instagram[0]);
                }
                if(data.responseJSON.errors.url != null){
                    $('.url').text(data.responseJSON.errors.url[0]);
                }
            },
            processData: false,
            contentType: false,
        });
    });
</script>
