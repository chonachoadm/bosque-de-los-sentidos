@extends('layouts.app')
@section('title', 'Crear Usuario')
@section('content')
<section>
    <h1 class="text-center">Creá un usuario nuevo</h1>
    <hr class="mb-5">
    <div class="row justify-content-center">
        <form action="{{ route('users.store') }}" method="POST" class="col-12 col-md-8 col-lg-6">
            @csrf
            <div class="form-row my-2">
                <label for="name">
                    Nombre
                </label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                <div><small class="alert alert-danger py-1 my-5"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="form-row my-2">
                <label for="email">
                    Correo electrónico
                </label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                <div><small class="alert alert-danger py-1 my-5"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="form-row my-2">
                <label for="password">
                    Contraseña
                </label>
                <input type="password" id="password" name="password" class="form-control">
                @error('password')
                <div><small class="alert alert-danger py-1 my-5"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="form-row my-2">
                <label for="password_confirmation">
                    Confirmar contraseña
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
            </div>
            <div class="my-4 text-center">
                <button type="submit" class="boton-enviar">Crear usuario</button>
            </div>
        </form>
    </div>
</section>
@endsection
