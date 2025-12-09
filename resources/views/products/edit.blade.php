@extends('layouts.app')
@section('title', 'Editar Producto')
@section('content')
<section>
    <h1 class="text-center">Editá {{ $product->name }}</h1>
    <hr class="mb-5">
    <div class="row justify-content-center">
        <form action="{{ route('products.update', $product)}}" method="POST" class="col-12 col-md-8 col-lg-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mt-4 form-row">
                <label for="name"><strong>Nombre</strong></label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}">
                @error('name')
                <div><small class="alert alert-danger"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="mt-4 form-row">
                <label for="description"><strong>Descripción</strong></label>
                <textarea name="description" id="description" class="form-control" rows="10">{{ old('description', $product->description) }}</textarea>
                @error('description')
                <div><small class="alert alert-danger"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="mt-4 form-row">
                <label for="price"><strong>Precio ($ ARS)</strong></label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}">
                @error('price')
                <div><small class="alert alert-danger"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="mt-4 form-row">
                <label for="stock"><strong>Stock</strong></label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
                @error('stock')
                <div><small class="alert alert-danger"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="mt-4 form-row">
                @if($product->image)
                <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid w-50">
                @endif
                <label for="image"><strong>Imagen</strong></label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                <div><small class="alert alert-danger"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="mt-4 form-row d-flex justify-content-center">
                <button type="submit" class="px-3 py-1 boton-agregar">Actualizar</button>
            </div>
        </form>
    </div>
</section>
@endsection
