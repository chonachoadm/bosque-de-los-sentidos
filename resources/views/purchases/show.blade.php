@extends('layouts.app')
@section('title', 'Detalle de Compra')
@section('content')
<section>
    <h1 class="text-center">
        Compra Nro. {{ $purchase->id }}
    </h1>
    <hr class="mb-5">
    <div>
        <p>
            <strong>Usuario: </strong>{{ $purchase->user->email}}
        </p>
        <p>
            <strong>ID de transacción: </strong>{{ $purchase->preference_id }}
        </p>
        <p>
            <strong>Estado de la transacción: </strong>{{ $purchase->status->status_name ?? 'N/A'}}
        </p>
    </div>
    <div class="table-responsive my-4">
        <table class="table table-bordered align-middle rounded-3 shadow-sm overflow-hidden">
            <thead class="header-tabla">
                <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Producto adquirido</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio por unidad</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="tabla-hover">
                    <td><img src="{{ asset('storage/images/games/' . $order->product->image) }}" alt="{{ $order->product->name }}" class="img-fluid w-25"></td>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>$ {{ number_format($order->unit_price, 0, '', '.') }}</td>
                    <td>$ {{ number_format($order->unit_price * $order->quantity, 0, '', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end fs-2 px-1">
            <p>
                <strong>Total: $ {{ number_format($purchase->total_amount, 0, '', '.') }}</strong>
            </p>
        </div>
    </div>
    <form action="{{ route('purchases.destroy', $purchase) }}" method="POST" class="text-center">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger px-2 py-1" onclick="return confirm('¿Estás seguro de querer eliminar la compra Nro. {{ $purchase->id }}?')">Eliminar</button>
    </form>
</section>
@endsection
