<link rel="stylesheet" href="{{asset('/css/navbar.css')}}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="barranav">
    Mapa PYMES
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
            @endauth
        @endif

    </div>
</div>