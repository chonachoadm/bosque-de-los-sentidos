@extends('layouts.app')
@section('title', 'Detalle de producto')
@section('content')
<section class="mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <img src="{{ asset('storage/images/games/' . $product->image) }}" class="img-fluid" alt="Portada del juego Memotoc">
        </div>
        <div class="col-12 col-md-5 ms-0 ms-md-5">
            <div class="d-flex align-items-center justify-content-between">
                <h1 class="m-0">
                    {{ $product->name }}
                </h1>
                <p class="m-0 me-lg-5 py-1 px-2 stock-detalle">
                    @if($product->stock > 0)
                    Stock: {{ $product->stock }}
                    @else
                    <em>Agotado</em>
                    @endif
                </p>
            </div>
            <p class="mt-5 precio-detalle">
                $ {{ number_format($product->price, 0, '', '.') }} ARS
            </p>
            <button class="py-2 mt-3 boton-comprar-detalle">Añadir al carrito</button>
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
