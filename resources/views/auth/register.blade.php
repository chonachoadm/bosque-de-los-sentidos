@extends('layouts.auth')
@section('title', 'Registrate')
@section('content')
<h1 class="text-center">
    Creá tu cuenta
</h1>
<section class="mt-5">
    <div>
        <h2 class="m-1 text-center">
            Completá el formulario para registrarte
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
    <div class="row justify-content-center">
        <form action="{{ route('register.store') }}" method="POST" class="col-12 col-md-8 col-lg-6">
            @csrf
            <div class="form-row my-2">
                <label for="name">
                    Nombre
                </label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-row my-2">
                <label for="email">
                    Correo electrónico
                </label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-row my-2">
                <label for="password">
                    Contraseña
                </label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-row my-2">
                <label for="password_confirmation">
                    Confirmar contraseña
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>
            <div class="my-4 text-center">
                <button type="submit" class="boton-enviar">Crear cuenta</button>
            </div>
        </form>
    </div>
</section>
@endsection
