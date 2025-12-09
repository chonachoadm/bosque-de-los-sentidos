@extends('layouts.app')
@section('title', 'Detalle de producto')
@section('content')
<section class="mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <img src="{{ asset('storage/images/games/' . $product->image) }}" class="img-fluid" alt="Portada del juego Memotoc">
        </div>
        <div class="col-12 col-md-5 ms-0 ms-md-5">
            <div class="d-flex flex-column align-items-start justify-content-between">
                <h1 class="m-0">
                    {{ $product->name }}
                </h1>
                <p class="m-0 me-lg-5 py-1 px-2">
                    @if($product->stock > 0 && $product->stock <= 10)
                        <em>{{ $product->stock }} unidades disponibles</em>
                        @elseif($product->stock > 10)
                        <em>10+ unidades disponibles</em>
                        @else
                        <em>Agotado</em>
                        @endif
                </p>
            </div>
            <p class="mt-5 precio-detalle">
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
            <p class="mt-4">
                {{ $product->description }}
            </p>
            <div>
                <ul class="p-0 mt-md-5 row justify-content-around">
                    @foreach($product->tags as $tag)
                    <li class="m-2 col-4 col-md-2 categoria-detalle">{{ $tag->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
