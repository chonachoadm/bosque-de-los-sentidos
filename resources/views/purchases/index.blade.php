@extends('layouts.app')
@section('title', 'Administrar Compras')
@section('content')
<section>
    <h1 class="text-center">
        Compras
    </h1>
    <hr class="mb-5">
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('purchases.create') }}" class="mb-4 boton-ver-mas text-decoration-none">Generar compra</a>
        <form action="{{ route('purchases.index') }}" method="get" class="d-flex align-items-center">
            @csrf
            <select name="status_id" id="status_id" aria-label="Buscar por estado de la transacción" class="form-control">
                <option value="0" selected>Filtrar por estado</option>
                @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                @endforeach
            </select>
            <button type="submit" class="boton-enviar py-1 px-2 ms-2 fs-6">Filtrar</button>
        </form>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        <small>{{session('success')}}</small>
    </div>
    @endif
    <div class="table-responsive my-2">
        <table class="table table-bordered align-middle rounded-3 shadow-sm overflow-hidden">
            <thead class="header-tabla">
                <tr>
                    <th scope="col">Nro. de orden</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Monto abonado</th>
                    <th scope="col">Estado de la transacción</th>
                    <th scope="col">Nro. de transacción</th>
                    <th scope="col">Fecha de la compra</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                <tr class="tabla-hover">
                    <td>{{ $purchase->id }}</td>
                    <td><a href="{{ route('users.show', $purchase->user->id) }}">{{ $purchase->user->email }}</a></td>
                    <td>$ {{ number_format($purchase->total_amount, 0, '', '.') }}</td>
                    <td>{{ $purchase->status->status_name ?? null }}</td>
                    <td>{{ $purchase->preference_id }}</td>
                    <td>{{ $purchase->created_at }}</td>
                    <td>
                        <ul class="list-unstyled">
                            <li class="my-3">
                                <a href="{{ route('purchases.show', $purchase) }}" class="text-decoration-none fs-6 px-2 py-1 boton-comprar">Ver</a>
                            </li>
                            <li class="my-3">
                                <a href="{{ route('purchases.edit', $purchase) }}" class="text-decoration-none fs-6 px-2 py-1 boton-comprar">Editar</a>
                            </li>
                            <li class="my-2">
                                <form action="{{ route('purchases.destroy', $purchase) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger px-2 py-1" onclick="return confirm('¿Estás seguro de querer eliminar la compra Nro. {{ $purchase->id }}?')">Eliminar</button>
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
        {{ $purchases->links() }}
    </div>
</section>
@endsection
