@extends('layouts.app')
@section('title', 'Administrar Categorías')
@section('content')
<section>
    <h1 class="text-center">
        Categorías
    </h1>
    <hr class="mb-5">
    <div class="mb-4">
        <a href="{{ route('tags.create') }}" class="mb-4 boton-ver-mas text-decoration-none">Crear categoría</a>
        @if(session('success'))
        <div class="alert alert-success">
            <small>{{session('success')}}</small>
        </div>
        @endif
    </div>
    <div class="table-responsive my-4">
        <table class="table table-bordered align-middle rounded-3 shadow-sm overflow-hidden">
            <thead class="header-tabla">
                <tr>
                    <th class="p-2 border border-black">ID</th>
                    <th class="p-2 border border-black">Nombre de la categoría</th>
                    <th class="p-2 border border-black">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                <tr class="tabla-hover">
                    <td class="p-2">{{ $tag->id }}</td>
                    <td class="p-2">{{ $tag->name }}</td>
                    <td class="p-2">
                        <ul class="list-unstyled mb-0">
                            <li class="my-3">
                                <a href="{{ route('tags.edit', $tag) }}" class="text-decoration-none fs-6 px-2 py-1 boton-comprar">Editar</a>
                            </li>
                            <li class="my-2">
                                <form action="{{ route('tags.destroy', $tag) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger px-2 py-1" onclick="return confirm('¿Estás seguro de querer eliminar {{ $tag->name }}?')">Eliminar</button>
                                </form>
                            </li>
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
