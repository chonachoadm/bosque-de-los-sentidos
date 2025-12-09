@extends('layouts.app')
@section('title', 'Editar categoría')
@section('content')
<section>
    <h1 class="text-center">Editá {{ $tag->name }}</h1>
    <hr class="mb-5">
    <div class="row justify-content-center">
        <form action="{{ route('tags.update', $tag) }}" method="POST" class="col-12 col-md-8 col-lg-6">
            @csrf
            @method('PUT')
            <div class="mt-4 form-row">
                <label for="name"><strong>Nombre</strong></label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $tag->name) }}">
                @error('name')
                <div><small class="alert alert-danger"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="mt-4 form-row d-flex justify-content-center">
                <button type="submit" class="px-3 py-1 boton-agregar">Agregar</button>
            </div>
        </form>
    </div>
</section>
@endsection
