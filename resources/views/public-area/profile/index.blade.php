@extends('layouts.app')
@section('title', 'Perfil de Usuario')
@section('content')
<div class="d-flex flex-column align-items-center">
    <h1 class="text-center">
        ¡Bienvenido/a, {{ auth()->user()->name }}!
    </h1>
</div>
<section class="mt-5">
    @if(session('info'))
    <div class="alert alert-warning">{{session('info')}}</div>
    @endif
    <div class="row justify-content-center mt-5">
        <div class="mx-5 mx-lg-3 mb-4 mb-md-0 col-12 col-md-8 col-lg-5">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-center">
                    Información personal
                </h2>
                <a href="{{ route('public-area.profile.edit', auth()->user()) }}" class="col-2"><img src="{{ asset('storage/images/icons/edit.png') }}" alt="Editar información personal"></a>
            </div>
            <hr>
            <div class="row align-items-center">
                <p class="m-0 col-12 col-md-10"><strong>Nombre:</strong> {{ auth()->user()->name }}</p>
            </div>
            <hr>
            <div class="row align-items-center">
                <p class="m-0 col-12 col-md-10"><strong>Correo electrónico:</strong>
                    {{ auth()->user()->email }}
                </p>
            </div>
            <hr>
            <div class="row align-items-center">
                <p class="m-0 col-12 col-md-10"><strong>Teléfono:</strong> {{ auth()->user()->profile->phone ?? 'Sin teléfono' }}</p>
            </div>
            <hr>
            <div class="row align-items-center">
                <p class="m-0 col-12 col-md-10"><strong>Dirección:</strong> {{ auth()->user()->profile->address ?? 'Sin dirección' }}</p>
            </div>
            <hr>
            <div class="row align-items-center">
                <p class="m-0 col-12 col-md-10"><strong>Fecha de nacimiento:</strong> {{ auth()->user()->profile->birth_date ?? 'Sin fecha de nacimiento' }}</p>
            </div>
        </div>
        <div class="mx-1 mt-5 mt-lg-0 col-12 col-md-8 col-lg-6">
            <h2 class="text-center">
                Últimas compras
            </h2>
            <hr>
            <div class="row justify-content-center table-responsive">
                <table class="table table-bordered align-middle rounded-3 shadow-sm overflow-hidden">
                    <thead class="header-tabla">
                        <tr>
                            <th scope="col">Nro. de orden</th>
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
                            <td>$ {{ number_format($purchase->total_amount, 0, '', '.') }}</td>
                            <td>{{ $purchase->status->status_name ?? null }}</td>
                            <td>{{ $purchase->preference_id }}</td>
                            <td>{{ $purchase->created_at }}</td>
                            <td>
                                <a href="{{ route('purchase.data', $purchase) }}" class="text-decoration-none fs-6 px-2 py-1 boton-comprar">Ver</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <form action="{{ route('logout') }}" method="POST" class="d-flex justify-content-center mt-5">
        @csrf
        <button type="submit" class="boton-cerrar-sesion" id="cerrar-sesion">Cerrar Sesión</button>
    </form>
</section>
@endsection
