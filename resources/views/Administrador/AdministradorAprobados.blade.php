<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{asset('/css/index.css')}}">
@include('navbar.navbar')

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

<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Solicitudes Aprobadas
                <div class="form-group mt-4 float-right">
                    <button type="submit" class="btn btn-primary">
                        <a href=" {{route('actualizarFormularioPendiente')}} " class="btn btn-primary"> Regresar </a>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <a href=" {{route('exportarFormulario')}} " class="btn btn-primary"> Exportar Excel </a>
                    </button>

                </div></h2>
        </div>
        <div>
            <br>
        </div>
        <input class="form-control" id="myInput" type="text" placeholder="Busque por rut, nombre, etc...">
        <div>
            <br>
        </div>
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Empresa</th>
                <th scope="col">Rut Empresa</th>
                <th scope="col">Giro</th>
                <th scope="col">¿Formalizado?</th>
                <th scope="col">Comuna</th>
                <th scope="col">Opciones</th>

            </tr>
            </thead>
            <tbody id="myTable">
                @foreach($formularios_aprobados as $formulario)
                    <tr>
                        <th scope="row">{!! $formulario->id !!}</th>
                        <th scope="row">{!! $formulario->nombre_empresa !!}</th>
                        <td scope="row">{!! $formulario->rut_empresa !!}</td>
                        <td scope="row">{!! $formulario->categoria !!}</td>
                        <td scope="row">{!! $formulario->formalizado !!}</td>
                        <td scope="row">{!! $formulario->comuna !!}</td>
                        <td>
                            <a href="/Administrador/editarAprobado/{{$formulario->id}}" class="btn btn-primary">
                                Detalles/Editar
                            </a>
                            <a class="btn btn-danger" href="#eliminar{{$formulario->id}}"data-toggle="modal">
                                Eliminar
                            </a>
                        </td>
                    </tr>

                    <div class="modal modal-danger fade" id="eliminar{{$formulario->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title text-center" id="myModalLabel">Confirmación</h4>
                                </div>

                                <form action="{{route('administradorEliminar', ['id'=> $formulario->id])}}" method="post">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <p class="text-center">
                                            ¿Está seguro de eliminar esta solicitud?
                                        </p>
                                        <input type="hidden" name="category_id" id="cat_id" value="">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-warning">Sí</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>

    </div>
</div>



<script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>


