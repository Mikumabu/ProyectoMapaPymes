<link rel="stylesheet" href="{{asset('/css/navbar.css')}}">
<div class="nav">
    Mapa PYMES
    @if (Route::has('login'))
        <a href="{{ url('/Mapa') }}">Home</a>
        @auth
            <a href="{{ url('/Administrador') }}">  Panel Administración</a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        @else
            <a href="{{ route('login') }}">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth

    @endif
</div>
