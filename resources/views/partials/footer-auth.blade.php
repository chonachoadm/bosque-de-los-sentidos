<hr class="separador-footer mt-0">
<div class=" mt-5 row justify-content-center">
    <div class="col-12 col-md-4 mt-3 text-center text-md-start">
        <h4>
            Datos de alumno
        </h4>
        <ul class="p-0">
            <li><strong>Nombre:</strong> Ignacio Lopez</li>
            <li><strong>Edad:</strong> 26 años</li>
            <li><strong>E-mail:</strong> ignacio.lopez01@davinci.edu.ar</li>
            <li><strong>Instagram:</strong> @chonachoadm</li>
        </ul>
    </div>
    <div class="col-12 col-md-4 text-center text-md-end mt-3">
        <h4>
            Directorios
        </h4>
        <ul class="p-0">
            <li><a href="{{ route('home') }}" class="card-titulo-link">Inicio</a></li>
            <li><a href="{{ route('about') }}" class="card-titulo-link">Sobre nosotros</a></li>
            <li><a href="{{ route('games') }}" class="card-titulo-link">Nuestros juegos</a></li>
            <li><a href="{{ route('contact') }}" class="card-titulo-link">Contacto</a></li>
            @if(auth()->user()->role->name == 'admin')
            <li><a href="{{ route('dashboard') }}" class="card-titulo-link">Dashboard</a></li>
            @endif
            <li><a href="{{ route('profile', auth()->user()) }}" class="card-titulo-link">Perfil</a></li>
        </ul>
    </div>
</div>
<div class="mt-5 row justify-content-center align-items-center">
    <p class="col-12 text-center">© 2024 Bosque de los Sentidos</p>
</div>
