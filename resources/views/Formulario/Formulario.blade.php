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
            <div class="form-group">
                <p align="left">Nombre Empresa <input type="text"
                                                      name="nombreEmpresa"
                                                      class="form-control"
                                                      id="nombreEmpresa"
                                                      placeholder="Ingrese Nombre Empresa">
                </p>
                <small class="nombre text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">Rut Empresa <input type="search"
                                                   name="rutEmpresa"
                                                   class="form-control"
                                                   id="rutEmpresa"
                                                   placeholder="Ingrese Rut Empresa">
                </p>
                <small class="rut text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">Giro <input type="search"
                                            name="queOfrece"
                                            class="form-control"
                                            id="queOfrece"
                                            placeholder="Ejemplo: Educación">
                </p>
                <small class="queOfrece text-danger">{{ $errors->first('queOfrece') }}</small>
            </div>
            <div class="form-group">
                <p align="left">(Opcional) Página de Facebook <input type="search"
                                                                     name="facebook"
                                                                     class="form-control"
                                                                     id="facebook"
                                                                     placeholder="Ingrese Link de Facebook Oficial">
                </p>
                <small class="facebook text-danger"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <p align="left">Dirección <input type="search"
                                                 name="calle"
                                                 class="form-control"
                                                 id="calle"
                                                 placeholder="Ejemplo: Blumel 1552">
                </p>
                <small class="calle text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">Comuna <input type="search"
                                              name="comuna"
                                              class="form-control"
                                              id="comuna"
                                              placeholder="Ejemplo: Antofagasta">
                </p>
                <small class="comuna text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">Horario de Atención <input type="search"
                                                          name="horario"
                                                          class="form-control"
                                                          id="horario"
                                                          placeholder="Ejemplo: 9:00 a 15:00">
                </p>
                <small class="horario text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">(Opcional) Página de Instagram <input type="search"
                                                                      name="instagram"
                                                                      class="form-control"
                                                                      id="instagram"
                                                                      placeholder="Ingrese Link de Instagram Oficial"
                    ></p>
                <small class="instagram text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">¿Formalizado? <select
                            id="formalizado"
                            name="formalizado"
                            class="form-control"
                            required>

                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select></p>
                <small class="formalizado text-danger"></small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <p align="left">Representante <input type="search"
                                                     name="contacto"
                                                     class="form-control"
                                                     id="contacto"
                                                     placeholder="Ingrese un Contacto. Por Ejemplo: Juan Pérez">
                </p>
                <small class="contacto text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">Teléfono <input type="search"
                                                name="telefono"
                                                class="form-control"
                                                id="telefono"
                                                placeholder="Ingrese un Teléfono">
                </p>
                <small class="telefono text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">Email <input type="search"
                                             name="email"
                                             class="form-control"
                                             id="email"
                                             placeholder="Ingrese un Email">
                </p>
                <small class="email text-danger"></small>
            </div>
            <div class="form-group">
                <p align="left">(Opcional) Otro sitio web <input type="search"
                                                                      name="url"
                                                                      class="form-control"
                                                                      id="url"
                                                                      placeholder="Ingrese Link de web u otra red social"
                    ></p>
                <small class="url text-danger"></small>
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
                                                   placeholder="Describa cómo es su empresa"
                                                   maxlength="300"
                                                   style="width:100%; height:200px;"
                    ></textarea></p>
                <div id="textarea_feedback"></div>
                <small class="descripcion text-danger"></small>
            </div>
        </div>
    </div>

    <div class="form-row justify-content-center">
            <label for="archivo"><b>Archivo: </b></label><br>
            <input type="file" name="archivo" required>
    </div>

    <div class="form-group">
        Por último, confirme la dirección de su empresa en el mapa
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
                <button type="submit" class="btn btn-primary">
                    {{ __('Ingresar Datos') }}
                </button>
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
                $('html, body').animate({ scrollTop: 0 }, 0);
                $('div.flash-message').html(data);
                document.getElementById("form-id").reset();
            },
            error: function(data){
                $('html, body').animate({ scrollTop: 0 }, 0);
                $('.nombre').text(data.responseJSON.errors.nombreEmpresa[0]);
                $('.rut').text(data.responseJSON.errors.rutEmpresa[0]);
                $('.queOfrece').text(data.responseJSON.errors.queOfrece[0]);
                $('.calle').text(data.responseJSON.errors.calle[0]);
                $('.comuna').text(data.responseJSON.errors.comuna[0]);
                $('.horario').text(data.responseJSON.errors.horario[0]);
                $('.contacto').text(data.responseJSON.errors.contacto[0]);
                $('.telefono').text(data.responseJSON.errors.telefono[0]);
                $('.email').text(data.responseJSON.errors.email[0]);
                if(data.responseJSON.errors.facebook[0] != null){
                    $('.facebook').text(data.responseJSON.errors.facebook[0]);
                }
                if(data.responseJSON.errors.instagram[0] != null){
                    $('.instagram').text(data.responseJSON.errors.instagram[0]);
                }
                if(data.responseJSON.errors.instagram[0] != null){
                    $('.url').text(data.responseJSON.errors.url[0]);
                }
            },
            processData: false,
            contentType: false,
        });
    });
</script>
