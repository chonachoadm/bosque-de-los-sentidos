@extends('layouts.app')
@section('title', 'Contactanos')
@section('content')
<section>
    <h1 class="text-center">¡Contactate con nosotros!</h1>
    <hr class="mb-5">
    <div class="row justify-content-center">
        <form action="#" method="get" class="col-12 col-md-8 col-lg-6">
            @csrf
            <div class="mb-4 form-row">
                @auth
                <p class="fs-4"><strong>Remitente: </strong>{{ auth()->user()->name }}</p>
                @endauth
                @guest
                <label for="name"><strong>Nombre</strong></label>
                <input type="text" name="name" id="name" class="form-control">
                @endguest
            </div>
            <div class="mb-4 form-row">
                @auth
                <p class="fs-4"><strong>E-mail: </strong>{{ auth()->user()->email }}</p>
                @endauth
                @guest
                <label for="email"><strong>Correo electrónico</strong></label>
                <input type="email" name="email" id="email" class="form-control">
                @endguest
            </div>
            <div class="mb-4 form-row">
                <label for="juegos"><strong>¿Qué juego te compraste?</strong></label>
                <select name="juegos" id="juegos" class="form-select">
                    @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4 form-row">
                <label for="mensaje"><strong>¡Contanos que te pareció!</strong></label>
                <textarea name="mensaje" id="mensaje" class="form-control" rows="5"></textarea>
            </div>
            <div class="mb-4 form-row d-flex justify-content-center">
                <button type="submit" onclick="return alert('¡Mensaje enviado!')" class="boton-enviar">Enviar</button>
            </div>
        </form>
    </div>
</section>
@endsection
