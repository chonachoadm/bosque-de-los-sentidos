@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<?php
$completedPurchases = $purchases->where('status_id', 1)->count();
$totalPurchases = $purchases->count();
$percentageOfCompletedPurchases = $completedPurchases / $totalPurchases * 100;

$usersPurchasers = 0;
foreach ($users as $user) {
    $hasPurchased = $purchases->where('user_id', $user->id)->where('status_id', 1)->count() > 0;
    if ($hasPurchased) {
        $usersPurchasers++;
    }
}
$totalUsers = $users->count();
$percentageOfUsersPurchasers = $usersPurchasers / $totalUsers * 100;

$mondayPurchases = $purchases->whereBetween('created_at', [now()->startOfWeek(), now()->startOfWeek()->addDay()])->count();
$tuesdayPurchases = $purchases->whereBetween('created_at', [now()->startOfWeek()->addDay(), now()->startOfWeek()->addDays(2)])->count();
$wednesdayPurchases = $purchases->whereBetween('created_at', [now()->startOfWeek()->addDay(2), now()->startOfWeek()->addDays(3)])->count();
$thursdayPurchases = $purchases->whereBetween('created_at', [now()->startOfWeek()->addDay(3), now()->startOfWeek()->addDays(4)])->count();
$fridayPurchases = $purchases->whereBetween('created_at', [now()->startOfWeek()->addDay(4), now()->startOfWeek()->addDays(5)])->count();
$saturdayPurchases = $purchases->whereBetween('created_at', [now()->startOfWeek()->addDay(5), now()->startOfWeek()->addDays(6)])->count();
$sundayPurchases = $purchases->whereBetween('created_at', [now()->startOfWeek()->addDay(6), now()->startOfWeek()->addDays(7)])->count();
$percentageOfMondayPurchases = $mondayPurchases / 10 * 100;
$percentageOfTuesdayPurchases = $tuesdayPurchases / 10 * 100;
$percentageOfWednesdayPurchases = $wednesdayPurchases / 10 * 100;
$percentageOfThursdayPurchases = $thursdayPurchases / 10 * 100;
$percentageOfFridayPurchases = $fridayPurchases / 10 * 100;
$percentageOfSaturdayPurchases = $saturdayPurchases / 10 * 100;
$percentageOfSundayPurchases = $sundayPurchases / 10 * 100;

$grossIncome = $purchases->where('status_id', 1)->sum('total_amount');
$bestClient = $users->where('id', $purchases->groupBy('user_id')->sortByDesc(function ($group) {
    return $group->where('status_id', 1)->sum('total_amount');
})->keys()->first())->first();
?>

@push('styles')
<style>
    :root {
        --compras-completadas: <?= $percentageOfCompletedPurchases ?>%;

        --usuarios-compradores: <?= $percentageOfUsersPurchasers ?>%;

        --monday-purchases: <?= $percentageOfMondayPurchases ?>%;
        --tuesday-purchases: <?= $percentageOfTuesdayPurchases ?>%;
        --wednesday-purchases: <?= $percentageOfWednesdayPurchases ?>%;
        --thursda-pPurchases: <?= $percentageOfThursdayPurchases ?>%;
        --friday-purchases: <?= $percentageOfFridayPurchases ?>%;
        --saturday-purchases: <?= $percentageOfSaturdayPurchases ?>%;
        --sunday-purchases: <?= $percentageOfSundayPurchases ?>%;
    }
</style>
@endpush

<section>
    <h1 class="text-center">Dashboard</h1>
    <hr class="mb-5">
    <div class="row justify-content-center caja-datos-dashboard">
        <div class="m-4 col d-flex flex-column align-items-center">
            <a href="{{ route('users.index') }}" class="link-datos-dashboard">
                <h3>
                    Usuarios
                </h3>
            </a>
            <p class="dato-dashboard">
                {{ $users->count() }}
            </p>
        </div>
        <div class="m-4 col d-flex flex-column align-items-center">
            <a href="{{ route('products.index') }}" class="link-datos-dashboard">
                <h3>
                    Productos
                </h3>
            </a>
            <p class="dato-dashboard">
                {{ $products->count()}}
            </p>
        </div>
        <div class="m-4 col d-flex flex-column align-items-center">
            <a href="{{ route('tags.index') }}" class="link-datos-dashboard">
                <h3>
                    Categorías
                </h3>
            </a>
            <p class="dato-dashboard">
                {{ $tags->count()}}
            </p>
        </div>
        <div class="m-4 col d-flex flex-column align-items-center">
            <a href="{{ route('purchases.index') }}" class="link-datos-dashboard">
                <h3>
                    Compras
                </h3>
            </a>
            <p class="dato-dashboard">
                {{ $purchases->count()}}
            </p>
        </div>
    </div>
    <div class="mt-5 row align-items-center justify-content-center justify-content-lg-around">
        <div class="mb-4 col-12 col-md-8 col-lg-5 d-flex flex-column align-items-center bg-white grafico-dashboard p-4">
            <h4>
                <strong>Dinero Recaudado</strong>
            </h4>
            <p class="grafico-dinero-recaudado">
                $ {{ number_format($grossIncome, 0, '', '.') }} ARS
            </p>
            <div class="d-flex flex-column align-items-center">
                <h5>
                    Cliente de oro
                </h5>
                <a href="{{ route('users.show', $bestClient->id) }}" class="cliente-de-oro">
                    {{ $bestClient->name ?? $bestClient->email }}
                </a>
            </div>
        </div>
        <div class="mb-4 col-12 col-md-8 col-lg-5 d-flex flex-column align-items-center bg-white grafico-dashboard p-4">
            <h4>
                <strong>Ventas de la semana</strong>
            </h4>
            <div class="grafico-ventas-semana">
                <div class="bar" style="height: var(--monday-purchases);"><span>Lunes</span></div>
                <div class="bar" style="height: var(--tuesday-purchases);"><span>Martes</span></div>
                <div class="bar" style="height: var(--wednesday-purchases);"><span>Miércoles</span></div>
                <div class="bar" style="height: var(--thursday-purchases);"><span>Jueves</span></div>
                <div class="bar" style="height: var(--friday-purchases);"><span>Viernes</span></div>
                <div class="bar" style="height: var(--saturday-purchases);"><span>Sábado</span></div>
                <div class="bar" style="height: var(--sunday-purchases);"><span>Domingo</span></div>
            </div>
        </div>
    </div>
    <div class="mt-5 row align-items-center justify-content-center justify-content-lg-around">
        <div class="mb-4 col-12 col-md-8 col-lg-5 d-flex flex-column align-items-center bg-white grafico-dashboard p-4">
            <h4>
                <strong>Usuarios compradores</strong>
            </h4>
            <div class="grafico-usuarios-compradores">
            </div>
            <div class="d-flex flex-column align-items-start">
                <div class="d-flex mt-2">
                    <div class="mx-2 marcador-exitosas"></div>
                    <small>
                        Usuarios compradores
                    </small>
                </div>
                <div class="d-flex mt-2">
                    <div class="mx-2 marcador-fallidas"></div>
                    <small>
                        Usuarios no compradores
                    </small>
                </div>
            </div>
        </div>
        <div class="mb-4 col-12 col-md-8 col-lg-5 d-flex flex-column align-items-center bg-white grafico-dashboard p-4">
            <h4>
                <strong>Compras efectuadas</strong>
            </h4>
            <div class="grafico-compras-completadas">
            </div>
            <div class="d-flex flex-column align-items-start">
                <div class="d-flex mt-2">
                    <div class="mx-2 marcador-exitosas"></div>
                    <small>
                        Transacciones exitosas
                    </small>
                </div>
                <div class="d-flex mt-2">
                    <div class="mx-2 marcador-fallidas"></div>
                    <small>
                        Transacciones fallidas
                    </small>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('logout') }}" method="POST" class="d-flex justify-content-center mt-5">
        @csrf
        <button type="submit" class="boton-cerrar-sesion" id="cerrar-sesion">Cerrar Sesión</button>
    </form>
</section>
@endsection
