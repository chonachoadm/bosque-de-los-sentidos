@extends('layouts.auth')
@section('title', 'Iniciar sesión')
@section('content')
<h1 class="text-center">
    Iniciar sesión
</h1>
<section class="mt-5">
    <div>
        <h2 class="m-1 text-center">
            Completá con tu información para ingresar a tu cuenta
        </h2>
        <hr>
    </div>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row justify-content-center">
        <form action="{{ route('login.store') }}" method="POST" class="col-12 col-md-8 col-lg-6">
            @csrf
            <div class="form-row my-2">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-row my-2">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="my-4 text-center">
                <button type="submit" class="boton-enviar">Ingresar</button>
            </div>
        </form>
    </div>
</section>
@endsection
