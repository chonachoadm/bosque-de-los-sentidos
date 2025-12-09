<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid px-5 py-3 caja-nav d-flex align-items-center justify-content-between">
        <img src="{{ asset('storage/images/icons/logo-bosque-arbol.svg') }}" class="img-fluid logo" alt="Logo Bosque de los Sentidos">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav"
            aria-controls="menuNav" aria-expanded="false" aria-label="Menú de navegación">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse barra-nav" id="menuNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 lista-nav d-flex align-items-center gap-4">
                <li class="nav-item elemento-nav"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                <li class="nav-item elemento-nav"><a class="nav-link" href="{{ route('about') }}">Sobre
                        nosotros</a></li>
                <li class="nav-item elemento-nav"><a class="nav-link" href="{{ route('games') }}">Juegos</a></li>
                <li class="nav-item elemento-nav"><a class="nav-link" href="{{ route('contact') }}">Contacto</a>
                </li>
                @if(auth()->user()->role->name == 'admin')
                <li class="nav-item elemento-nav"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                @endif
                <li class="nav-item elemento-nav"><a class="nav-link" href="{{ route('profile', auth()->user()) }}">Perfil</a></li>
                <li class="nav-item elemento-nav">
                    <form action="{{ route('logout') }}" method="POST" class="nav-item elemento-nav">
                        @csrf
                        <button class="nav-link" type="submit">Cerrar sesión</button>
                    </form>
                </li>
                <li class="nav-item elemento-nav">
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        <img src="{{ asset('storage/images/icons/carrito.png') }}" alt="Carrito de compras">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
