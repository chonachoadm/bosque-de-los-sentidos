@extends('layouts.app')
@section('title', 'Historial de compras')
@section('content')
<section>
    <h1 class="text-center">
        Historial de compras de {{ $user->name }}
    </h1>
    <hr class="mb-5">
    <div class="table-responsive my-4">
        <table class="table table-bordered align-middle rounded-3 shadow-sm overflow-hidden">
            <thead class="header-tabla">
                <tr>
                    <th>Nro. de transacción</th>
                    <th>Fecha de la compra</th>
                    <th>Productos comprados</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                <tr class="tabla-hover">
                    <td class="p-2">{{ $purchase->id }}</td>
                    <td class="p-2">{{ $purchase->created_at }}</td>
                    <td class="p-2">
                        <ul class="list-unstyled mb-0">
                            @foreach($purchase->products as $product)
                            <li>
                                <ul class="list-unstyled mb-0 d-flex justify-content-between col-12">
                                    <li>
                                        <strong>{{ $product->pivot->quantity }}</strong> {{ $product->name }}
                                    </li>
                                    <li>
                                        $ {{ number_format($product->price, 0, '', '.') }} ARS
                                    </li>
                                </ul>
                                <hr class="m-1">
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <td><strong>$ {{ number_format($purchase->total_amount, 0, '', '.') }} ARS</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
