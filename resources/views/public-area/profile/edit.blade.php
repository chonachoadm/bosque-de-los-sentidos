@extends('layouts.app')
@section('title', 'Editar Perfil')
@section('content')
<section>
    <h1 class="text-center">Editar perfil</h1>
    <hr class="mb-5">
</section>
<section>
    <div>
        <h2 class="text-center">
            Modifica tus datos personales
        </h2>
    </div>
    <div class="row justify-content-center">
        <form action="{{ route('public-area.profile.update')}}" method="POST" class="col-12 col-md-8 col-lg-6">
            @csrf
            @method('PUT')
            <div class="form-row my-2">
                <label for="name">
                    Nombre
                </label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}">
                @error('name')
                <div><small class="alert alert-danger py-1 my-5"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="form-row my-2">
                <label for="email">
                    Correo electrónico
                </label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}">
                @error('email')
                <div><small class="alert alert-danger py-1 my-5"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="form-row my-2">
                <label for="phone">
                    Teléfono
                </label>
                <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone', auth()->user()->profile->phone) }}">
                @error('phone')
                <div><small class="alert alert-danger py-1 my-5"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="form-row my-2">
                <label for="address">
                    Dirección
                </label>
                <input type="text" id="address" name="address" class="form-control" value="{{ old('address', auth()->user()->profile->address) }}">
                @error('address')
                <div><small class="alert alert-danger py-1 my-5"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="form-row my-2">
                <label for="birth_date">
                    Fecha de nacimiento
                </label>
                <input type="date" id="birth_date" name="birth_date" class="form-control" value="{{ old('birth_date', auth()->user()->profile->birth_date) }}">
                @error('birth_date')
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
