@extends('layouts.app')
@section('title', 'Administrar Usuarios')
@section('content')
<section>
    <h1 class="text-center">
        Usuarios
    </h1>
    <hr class="mb-5">
    <div>
        <a href="{{ route('users.create') }}" class="mb-4 boton-ver-mas text-decoration-none">Crear usuario</a>
    </div>
    @if(session('success'))
    <div class="alert alert-success py-1 my-2">
        <small>{{session('success')}}</small>
    </div>
    @endif
    <div class="table-responsive my-4">
        <table class="table table-bordered align-middle rounded-3 shadow-sm overflow-hidden">
            <thead class="header-tabla">
                <tr>
                    <th>Fecha de registro</th>
                    <th>Correo electrónico</th>
                    <th>Nombre</th>
                    <th>Historial de compras</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="tabla-hover">
                    <td class="p-2">{{ $user->created_at }}</td>
                    <td class="p-2">{{ $user->email }}</td>
                    <td class="p-2">{{ $user->name }}</td>
                    <td class="p-2"><a href="{{ route('users.purchase-history', $user) }}">Ver historial</a></td>
                    <td class="p-2">
                        <ul class="list-unstyled mb-0">
                            <li class="my-3"><a href="{{ route('users.show', $user) }}" class="text-decoration-none fs-6 px-2 py-1 boton-comprar">Ver</a></li>
                            <li class="my-3"><a href="{{ route('users.edit', $user) }}" class="text-decoration-none fs-6 px-2 py-1 boton-comprar">Editar</a></li>
                            <li class="my-2">
                                <form action="{{ route('users.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger px-2 py-1" onclick="return confirm('¿Estás seguro de querer eliminar {{ $user->name }}?')">Eliminar</button>
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
        {{ $users->links() }}
    </div>
</section>
@endsection
