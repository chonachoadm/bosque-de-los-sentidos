@extends('layouts.app')
@section('title', 'Administrar Productos')
@section('content')
<section>
        <h1 class="text-center">
            Productos
        </h1>
        <hr class="mb-5">
        <div>
            <a href="{{ route('products.create') }}" class="mb-4 boton-ver-mas text-decoration-none">Crear producto</a>
        </div>
    @if(session('success'))
    <div class="alert alert-success">
        <small>{{session('success')}}</small>
    </div>
    @endif
    <div class="table-responsive my-4">
        <table class="table table-bordered align-middle rounded-3 shadow-sm overflow-hidden">
            <thead class="header-tabla">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr class="tabla-hover">
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 0, '', '.') }}</td>
                    <td>{{ $product->stock }}</td>
                    <td class="w-50"><img src="{{ asset('storage/images/games/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid w-25"></td>
                    <td>
                        <ul class="list-unstyled">
                            <li class="my-3">
                                <a href="{{ route('products.show', $product) }}" class="text-decoration-none fs-6 px-2 py-1 boton-comprar">Ver</a>
                            </li>
                            <li class="my-3">
                                <a href="{{ route('products.edit', $product) }}" class="text-decoration-none fs-6 px-2 py-1 boton-comprar">Editar</a>
                            </li>
                            <li class="my-2">
                                <form action="{{ route('products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger px-2 py-1" onclick="return confirm('¿Estás seguro de querer eliminar {{ $product->name }}?')">Eliminar</button>
                                </form>
                            </li>
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="container">
        {{ $products->links() }}
    </div>
</section>
@endsection
