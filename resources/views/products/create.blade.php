@extends('layouts.app')
@section('title', 'Crear Producto')
@section('content')
<section>
    <h1 class="text-center">Agregá un producto</h1>
    <hr class="mb-5">
    <div class="row justify-content-center">
        <form action="{{ route('products.store') }}" method="POST" class="col-12 col-md-8 col-lg-6" enctype="multipart/form-data">
            @csrf
            <div class="mt-4 form-row">
                <label for="name"><strong>Nombre</strong></label>
                <input type="text" name="name" id="name" class="form-control">
                @error('name')
                <div><small class="alert alert-danger"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="mt-4 form-row">
                <label for="description"><strong>Descripción</strong></label>
                <textarea name="description" id="description" class="form-control"></textarea>
                @error('description')
                <div><small class="alert alert-danger"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="mt-4 form-row">
                <label for="price"><strong>Precio ($ ARS)</strong></label>
                <input type="number" name="price" id="price" class="form-control">
                @error('price')
                <div><small class="alert alert-danger"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="mt-4 form-row">
                <label for="stock"><strong>Stock</strong></label>
                <input type="number" name="stock" id="stock" class="form-control">
                @error('stock')
                <div><small class="alert alert-danger"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="mt-4 form-row">
                <label for="image"><strong>Imagen</strong></label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
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
