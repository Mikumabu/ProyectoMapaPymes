<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{asset('/css/index.css')}}">
@include('navbar.navbar')
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Palabras Prohibidas
        </div>
        <td>

            <form method="POST" action="{{ route('ingresarInsulto') }}" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="form-group">
                    <p align="left">Agregar Palabra Prohibida/Insulto <input type="search"
                                                                             name="insulto"
                                                                             class="form-control"
                                                                             id="insulto"
                                                                             placeholder="Ingrese un Insulto. Por Ejemplo: Idiota">
                    </p>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Ingresar') }}
                        </button>
                    </div>
                </div>

            </form>

        </td>
        <div>
            <br>
        </div>
        <div>
            <br>
        </div>
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Listado de Palabras Prohibidas/Insultos</th>

            </tr>
            </thead>
            <tbody id="myTable">
            @foreach($palabras_prohibidas as $palabra)
                <tr>
                    <th scope="row">{!! $palabra->insulto !!}</th>

                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>

@if ($message = Session::get('exito1'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

