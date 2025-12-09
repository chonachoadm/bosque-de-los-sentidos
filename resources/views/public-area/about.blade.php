@extends('layouts.app')
@section('title', 'Sobre Nosotros')
@section('content')
<h1 class="text-center">
    Conocé nuestra historia
</h1>
<section class="mt-5">
    <div>
        <h2 class="text-center">
            ¿Quiénes somos?
        </h2>
        <hr>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-5">
            <p>
                Somos un grupo de docentes y estudiantes interesados en transformar al mundo a través del juego.
                Creemos que el juego es (y debe ser) una <strong>herramienta fundamental</strong> en el
                desarrollo de niños y adultos, por lo
                cual nos propusimos crear una ludoteca que esté al alcance de quienes no les es sencillo
                encontrar
                juegos adaptados a sus necesidades.
            </p>
            <p>
                Las personas con discapacidad tienen el mismo derecho a jugar y aprender al mismo ritmo que los
                demás.
                Por eso, en <strong>El Bosque de los Sentidos</strong>, nos dedicamos a seleccionar y ofrecer
                juegos para que todos
                puedan disfrutar de ellos sin barreras.
            </p>
        </div>
        <div class="col-12 col-md-8 col-lg-5">
            <img src="{{ asset('storage/images/about/equipo.jpg') }}" class="img-fluid img-nosotros"
                alt="El Equipo detrás de Bosque de los Sentidos">
        </div>
    </div>
    <div class="w-100 mt-5 text-center row justify-content-center">
        <h3>
            Algunas de nuestras propuestas
        </h3>
        <hr class="w-50">
    </div>
    <div class="row justify-content-center">
        <div class="mb-4 col-12 col-md-5 col-lg-3"><img src="{{ asset('storage/images/about/chicos-5.jpg') }}"
                class="img-fluid img-nosotros" alt="Superficies de texturas"></div>
        <div class="mb-4 col-12 col-md-5 col-lg-3"><img src="{{ asset('storage/images/about/grandes-2.webp') }}"
                class="img-fluid img-nosotros" alt="Cubo rubik texturado"></div>
        <div class="mb-4 col-12 col-md-5 col-lg-3"><img src="{{ asset('storage/images/about/chicos-3.webp') }}"
                class="img-fluid img-nosotros" alt="Familia construyendo con bloques de colores"></div>
    </div>
</section>
<section class="mt-5">
    <div>
        <h2 class="text-center">
            Nuestra misión
        </h2>
        <hr>
    </div>
    <div class="row justify-content-center">
        <div class="mb-4 col-12 col-md-8 col-lg-5">
            <img src="{{ asset('storage/images/about/chicos-1.jpg') }}" class="img-fluid img-nosotros"
                alt="Niños abrazándose felices">
        </div>
        <div class="col-12 col-lg-5">
            <p>
                Últimamente se perdió la esencia del aprendizaje dentro del juego. Niños y niñas juegan por
                jugar, docentes y familias proponen juegos pensando en qué tan divertidos son o qué tanto
                entretienen a
                las infancias.
            </p>
            <p>
                Nuestra misión es <strong>recuperar el juego como herramienta de aprendizaje</strong>, y para
                eso
                ofrecemos juegos que, además de ser divertidos, son inclusivos y adaptados a las necesidades de
                cada persona.
                No olvidemos que los juegos se inventaron con el objetivo de lograr que las infancias aprendan
                de manera dinámica y entretenida.
            </p>
            <p>
                <strong>Jugar es un derecho</strong>, y en El Bosque de los Sentidos queremos que todos y todas
                puedan acceder a él.
            </p>
        </div>
    </div>
</section>
@endsection
