@extends('layouts.app')
@section('title', 'El Bosque de los Sentidos')
@section('content')

@if(session('error'))
<div class="alert alert-danger">
    <p>{{ session('error') }}</p>
</div>
@elseif(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<h1 class="text-center">
    El Bosque de los Sentidos
</h1>
<div class="row d-flex justify-content-center">
    <div class="col-12 col-md-10 text-center">
        <p>
            Un espacio pensado para que todas las infancias puedan jugar y aprender sin barreras.
        </p>
    </div>
</div>
<section class="mt-5">
    <div>
        <h2 class="m-1 text-center">
            ¡Destacados!
        </h2>
        <hr>
    </div>
    <div class="row justify-content-center">
        @foreach($featuredProducts as $featuredProduct)
        @if($featuredProduct->stock > 15)
        <div class="m-4 card col-12 col-md-5 col-lg-3 card-sombra">
            <a href="{{ route('details', $featuredProduct) }}">
                <img src="{{ asset('storage/images/games/' . $featuredProduct->image) }}" class="card-img-top" alt="{{ $featuredProduct->name }}">
            </a>
            <hr>
            <div class="card-body d-flex flex-column">
                <div class="mb-2 d-flex justify-content-between align-items-center">
                    <a href="{{ route('details', $featuredProduct) }}" class="card-titulo-link">
                        <h3 class="card-title m-0">
                            {{ $featuredProduct->name }}
                        </h3>
                    </a>
                </div>
                <p class="card-text">
                    $ {{ number_format($featuredProduct->price, 0, '', '.') }} ARS
                </p>
                @auth
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $featuredProduct->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="w-100 py-2 px-4 boton-comprar">Añadir al carrito</button>
                </form>
                @endauth
                @guest
                <a href="{{ route('login') }}" class="py-2 px-4 boton-comprar text-center text-decoration-none">Añadir al carrito</a>
                @endguest
            </div>
        </div>
        @endif
        @endforeach
    </div>
</section>
<section class="mt-5">
    <div>
        <h2 class="m-1 text-center">
            ¿Quiénes somos?
        </h2>
        <hr>
    </div>
    <div class="row justify-content-center">
        <p class="col-12 col-md-10">
            Somos un grupo de docentes y estudiantes interesados en transformar al mundo a través del juego.
            Creemos que el juego es (y debe ser) una <strong>herramienta fundamental</strong> en el
            desarrollo de niños y adultos, por lo
            cual nos propusimos crear una ludoteca que esté al alcance de quienes no les es sencillo
            encontrar
            juegos adaptados a sus necesidades.
        </p>
    </div>
    <div class="row justify-content-center">
        <img src="{{ asset('storage/images/about/equipo.jpg') }}" class="p-0 m-4 col-12 col-md-5 img-fluid img-nosotros"
            alt="Nuestro equipo de trabajo">
        <div class="col-12 col-md-5">
            <h3>
                Nuestra misión
            </h3>
            <hr>
            <p>
                Nuestra misión es <strong>recuperar el juego como herramienta de aprendizaje</strong>, y para
                eso
                ofrecemos juegos que, además de ser divertidos, son inclusivos y adaptados a las necesidades de
                cada persona.
                No olvidemos que los juegos se inventaron con el objetivo de lograr que las infancias aprendan
                de manera dinámica y entretenida.
            </p>
        </div>
    </div>
</section>
<section class="mt-5">
    <div>
        <h2 class="m-1 text-center">
            Nuestros juegos
        </h2>
        <hr>
    </div>
    <div class="row justify-content-center">
        @foreach($products as $product)
        <div class="m-2 card col-12 col-md-5 col-lg-2 card-sombra">
            <a href="{{ route('details', $product) }}">
                <img src="{{ asset('storage/images/games/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            </a>
            <hr>
            <div class="card-body d-flex flex-column">
                <div class="mb-2 d-flex justify-content-between align-items-center">
                    <a href="{{ route('details', $product) }}" class="card-titulo-link">
                        <h3 class="card-title m-0">
                            {{ $product->name }}
                        </h3>
                    </a>
                </div>
                <p class="card-text">
                    $ {{ number_format($product->price, 0, '', '.') }} ARS
                </p>
                @auth
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="w-100 py-2 px-4 boton-comprar">Añadir al carrito</button>
                </form>
                @endauth
                @guest
                <a href="{{ route('login') }}" class="py-2 px-4 boton-comprar text-center text-decoration-none">Añadir al carrito</a>
                @endguest
            </div>
        </div>
        @endforeach
    </div>
    <div class="me-0 me-md-5 row justify-content-end">
        <div class="col-8 col-md-4 col-lg-2 d-flex justify-content-end p-0">
            <form action="{{ route('games') }}" method="get">
                @csrf
                <button class="boton-ver-mas" type="submit" id="ver-mas">
                    Ver más <strong>-></strong>
                </button>
            </form>
        </div>
    </div>
</section>
<section class="mt-5">
    <div>
        <h2 class="m-1 text-center">
            ¡Hablá con nosotros!
        </h2>
        <hr>
    </div>
    <div class="row justify-content-center">
        <form action="#" method="get" class="col-12 col-md-8 col-lg-6">
            @csrf
            <div class="form-row my-2">
                @auth
                <p class="fs-5"><strong>Remitente: </strong>{{ auth()->user()->name }}</p>
                @endauth
                @guest
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control">
                @endguest
            </div>
            <div class="form-row my-2">
                @auth
                <p class="fs-5"><strong>E-mail: </strong>{{ auth()->user()->email }}</p>
                @endauth
                @guest
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" class="form-control">
                @endguest
            </div>
            <div class="form-row my-2">
                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" rows="5" id="mensaje" class="form-control"></textarea>
            </div>
            <div class="form-row my-4 text-end">
                <button type="submit" class="boton-enviar" onclick="return alert('¡Mensaje enviado!')">Enviar</button>
            </div>
        </form>
    </div>
</section>
@endsection
