@extends('layouts.app')
@section('title', 'Editar Usuario')
@section('content')
<section>
    <h1 class="text-center">Editar usuario: {{ $user->email }}</h1>
    <hr class="mb-5">
    <div class="row justify-content-center">
        <form action="{{ route('users.update', $user)}}" method="POST" class="col-12 col-md-8 col-lg-6">
            @csrf
            @method('PUT')
            <div class="form-row my-2">
                <label for="name">
                    Nombre
                </label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                @error('name')
                <div><small class="alert alert-danger py-1 my-5"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="form-row my-2">
                <label for="email">
                    Correo electrónico
                </label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                @error('email')
                <div><small class="alert alert-danger py-1 my-5"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="my-4 text-center">
                <button type="submit" class="boton-enviar">Actualizar información</button>
            </div>
        </form>
    </div>
</section>
@endsection
