@extends('layouts.app')
@section('title', 'Carrito')
@section('content')

<section>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @elseif(session('info'))
    <div class="alert alert-warning">{{ session('info') }}</div>
    @endif

    @if($cartItems->count() > 0)
    <h1 class="text-center">
        Tu carrito
    </h1>
    @else
    <h1 class="text-center">
        ¡Tu carrito está vacío!
    </h1>
    @endif
    <hr class="mb-5">
    <ul class="p-0">
        @foreach($cartItems as $item)
        <li class="elemento-carrito">
            <div class="row">
                <div class="mb-4 col-6 col-md-2 col-lg-1">
                    <img src="{{ asset('storage/images/games/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-fluid">
                </div>
                <div class="mb-4 col-6 col-md-2 d-flex flex-column justify-content-center">
                    <p class="m-0"><strong>{{ $item->product->name }}</strong></p>
                    <p class="my-0">$ {{ number_format($item->product->price, 0, '', '.') }} ARS</p>
                </div>
                <div
                    class="mb-4 col-6 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                    <div class="d-flex align-items-center caja-contador-carrito">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="me-2">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="action" value="decrement">
                            <button type="submit" class="boton-cantidad-carrito">-</button>
                        </form>
                        <p class="my-0 mx-2">{{ $item->quantity }}</p>
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="ms-2">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="action" value="increment">
                            <button type="submit" class="boton-cantidad-carrito">+</button>
                        </form>
                    </div>
                </div>
                <div class="mb-4 col-6 col-md-2 d-flex align-items-center">
                    <p class="m-0"><strong>$ {{ number_format($item->product->price * $item->quantity, 0, '', '.') }} ARS</strong></p>
                </div>
                <div class="mb-4 col-12 col-md-2 d-flex align-items-center justify-content-center">
                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="boton-eliminar">Eliminar</button>
                    </form>
                </div>
            </div>
            <hr>
        </li>
        @endforeach
    </ul>
    <div class="row justify-content-around">
        <div class="col-4 col-md-8 d-flex align-items-center justify-content-start justify-content-md-end">
            <p class="total-carrito">Total:</p>
        </div>
        <div class="p-0 col-6 col-md-2 d-flex align-items-center justify-content-end">
            <p class="total-carrito">$
                <?php
                $total = 0;
                foreach ($cartItems as $item) {
                    $total += $item->product->price * $item->quantity;
                }
                ?>
                {{ number_format($total, 0, '', '.') }} ARS
            </p>
        </div>
    </div>
    <div class="row flex-column-reverse flex-md-row justify-content-around">
        @if(!$cartItems->isEmpty())
        <form action="{{ route('cart.clear') }}" method="POST" class="p-0 col-12 col-md-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-100 py-2 mb-4 boton-vaciar-carrito">Vaciar carrito</button>
        </form>
        @endif
        <div class="mb-4 col-12 col-md-2 py-2">
            @if($cartItems->count() > 0)
            <div id="walletBrick_container"></div>
            @else
            <form action="{{ route('games') }}" method="GET">
                @csrf
                <button type="submit" class="w-100 boton-ver-mas"><em>Ir a la Ludoteca</em></button>
            </form>
            @endif
        </div>
    </div>
</section>

@if($cartItems->count() > 0)
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const publicKey = "{{ env('MERCADO_PAGO_PUBLIC_KEY') }}";
    const purchaseOrderId = "{{ $purchaseOrder->id }}";

    const mp = new MercadoPago(publicKey, {
        locale: 'es-AR'
    });

    const bricksBuilder = mp.bricks();
    const renderWalletBrick = async (bricksBuilder) => {
        await bricksBuilder.create("wallet", "walletBrick_container", {
            initialization: {
                preferenceId: purchaseOrderId,
                redirectMode: 'self',
            },
            customization: {
                texts: {
                    action: 'pay',
                    valueProp: 'security_safety',
                },
            },
        });
    };
    renderWalletBrick(bricksBuilder);
</script>
@endif
@endsection
