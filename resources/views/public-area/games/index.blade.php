@extends('layouts.app')
@section('title', 'Ludoteca')
@section('content')

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@elseif(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@elseif(session('info'))
<div class="alert alert-warning">{{ session('info') }}</div>
@endif

<h1 class="text-center">
    Ludoteca
</h1>
<section class="mt-5">
    <div>
        <h2 class="text-center">
            Nuestros destacados
        </h2>
        <hr>
    </div>
    <div class="row justify-content-center">
        @foreach($products as $product)
        @if($product->stock > 15)
        <div class="m-4 card col-12 col-md-4 col-lg-3 card-sombra">
            <a href="{{ route('details', $product) }}">
                <img src="{{ asset('storage/images/games/' . $product->image) }}" class="card-img-top" alt="Juego 1">
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
        @endif
        @endforeach
    </div>
</section>
<section class="mt-5">
    <div>
        <h2 class="text-center">
            Todos los juegos
        </h2>
        <hr>
    </div>
    <div class="row justify-content-center">
        @foreach($products as $product)
        <div class="m-4 card col-12 col-md-4 col-lg-3 col-xl-2 card-sombra">
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
</section>
@endsection
