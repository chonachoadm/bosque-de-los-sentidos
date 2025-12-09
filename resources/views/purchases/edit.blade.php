@extends('layouts.app')
@section('title', 'Editar Compra')
@section('content')
<section>
    <h1 class="text-center">Modificá la compra {{ $purchase->id }}</h1>
    <hr class="mb-5">
    <div class="row justify-content-center">
        <form action="{{ route('purchases.update', $purchase) }}" method="POST" class="col-12 col-md-8 col-lg-6">
            @csrf
            @method('PUT')
            <div class="mt-4 mx-2 form-row">
                <label for="user_id"><strong>Usuario</strong></label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach($users as $user)
                    @if(old('user_id', $purchase->user_id) == $user->id)
                    <option value="{{ $user->id }}" selected>{{ $user->email }}</option>
                    @else
                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                    @endif
                    @endforeach
                </select>
                @error('user_id')
                <div><small class="alert alert-danger"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="mt-4 form-row d-flex flex-wrap justify-content-center justify-content-between w-100">
                @foreach($products as $product)
                <label for="product-{{ $product->id }}" class="d-flex m-2 p-2 col-3 card card-sombra card-select">
                    <input type="checkbox" id="product-{{ $product->id }}" name="products[]" value="{{ $product->id }}">
                    <span class="w-100 d-flex flex-column align-items-center fs-5">
                        <img
                            src="{{ asset('storage/images/games/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="img-fluid mb-2">
                        <strong>{{ $product->name }}</strong>
                    </span>
                </label>
                @endforeach
                @error('products')
                <div><small class="alert alert-danger"> {{ $message }}</small></div>
                @enderror
            </div>
            <div class="mt-4 mx-2 form-row">
                <label for="status_id"><strong>Estado del pago</strong></label>
                <select name="status_id" id="status_id" class="form-control">
                    @foreach($statuses as $status)
                    @if(old('status_id', $purchase->status_id) == $status->id)
                    <option value="{{ $status->id }}" selected>{{ $status->status_name }}</option>
                    @else
                    <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                    @endif
                    @endforeach
                </select>
                @error('status_id')
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
