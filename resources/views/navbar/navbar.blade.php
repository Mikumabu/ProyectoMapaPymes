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
                <a href="{{ url('/Mapa') }}">Home</a>
        @endif
    </div>
</div>