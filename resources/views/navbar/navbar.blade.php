<link rel="stylesheet" href="{{asset('/css/navbar.css')}}">
<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="imgBar">
    <img id="banner" src="{{ Storage::url('Banner.jpg') }}">
</div>
<div class="barra">
    @if (Route::has('login'))
        @auth
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="{{ url('/Administrador') }}">  Panel Administración</a>
        @else
            <a href="{{ route('login') }}">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
        <a href="{{ url('') }}">Home</a>
        <a href="{{ route('formulario') }}">¿Eres emprendedor? Pon tu vitrina acá</a>
    @endif
</div>
<div class="barDropdown">
    <div class="opcion">
        <a href="{{ url('') }}">Home</a>
    </div>
    @if(Route::has('login'))
        @auth
            <div class="opcion">
                <a href="{{ url('/Administrador') }}">  Panel Administración</a>
            </div>
            <div class="opcion">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            </div>
            <div class="opcion">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        @else
            <div class="opcion">
                <a href="{{ route('login') }}">Login</a>
            </div>
            <div class="opcion">
                <a href="{{ route('formulario') }}">¿Eres emprendedor? Pon tu vitrina acá</a>
            </div>
        @endauth
    @endif

</div>