@extends('layouts.web')
@section('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@endsection
@section('navbar')
<!--MAIN MENU WRAP BEGIN-->
        <div class="main-menu-wrap sticky-menu">
            <div class="container">
                <a href="{{ route('inicio') }}" class="custom-logo-link">
                    <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                </a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#team-menu" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                    <nav class="navbar">
                        <div class="collapse navbar-collapse" id="team-menu">
                            <ul class="main-menu nav">
                                <li class="active">
                                    <a href="{{ route('inicio') }}"><span>Home</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('stadiums') }}"><span>Estadios</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('teams') }}"><span>Equipos</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('competitions') }}"><span>Ligas</span></a>
                                </li>
                                <li>
                                    <a>
                                        <span><i class="fa fa-power-off" aria-hidden="true"></i></span>
                                    </a>
                                    <ul>
                                        @if (Route::has('login'))
                                            @auth
                                                <li><a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a></li>
                                            @else
                                                <li><a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a></li>
                                                @if (Route::has('register'))
                                                    <li><a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a></li>
                                                @endif
                                            @endauth                        
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div>       
                    </nav>
            </div>
        </div>
@endsection


@section('body')
<!--MAIN MENU WRAP END-->
<div class="main-slider-section">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container main-slider-caption">
                    <h1>Bienvenido</h1>
                    <p>
                        En este proyecto encontrar??s distintas maneras de crear y consultar datos usando el framework Laravel. Ver??s el uso de m??dulos de seguridad b??sicos pero funcionales y escalables para usar en otros proyectos. Asimismo, tambi??n encontrar??s consultas a bases de datos estructuradas fundamentales para el dise??o de los datos aqu?? plasmados. Dale un vistazo a como presentamos la informacion de los estadios
                    </p>
                    <div class="col-md-12 booking"><a href="{{ route('stadiums') }}">Estadios</a></div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container main-slider-caption">
                    <h1>Herramientas, Tecnolog??as y Habilidades</h1>
                    <p>
                        El proyecto est?? formado usando los framworks Laravel y Bootstrap, todo enmarcado en la arquitectura MVC. Adicionalmente para el manejo de bases de datos, se emple?? el motos MySQL. Naturalmente, los lenguajes de programaci??n empleados son PHP, CSS, HTML, JavaScript y SQL.
                    </p>
                    <p>
                        Hay trucos especiales para el manejo de Relaciones y atributos pivotes del MER disponibles en las utilidades de Laravel que tambien son empleados aqu??, junto con un peque??o Snipe de JS para la ejecuci??n del Drag&Drop
                    </p>
                    <p>
                        Dale una ojeada a la lista de equipos que precargamos en este proyecto
                    </p>
                    <div class="col-md-12 booking"><a href="{{ route('teams') }}">Equipos</a></div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container main-slider-caption">
                    <h1>Sobre el contenido del proyecto</h1>
                    <p>
                        El proyecto maneja informaci??n sobre regiones, equipos, competiciones y estadios. Una manera interactiva de mostrar informaci??n relacionada variando vistas y dise??os alternativos
                    </p>
                    <p>
                        Distintas Competiciones y temporadas listas para ser visualizadas
                    </p>
                    <div class="col-md-12 booking"><a href="{{ route('competitions') }}">Ligas</a></div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
</div>

        <section class="success-story sport">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h4>Evelio Ram&iacute;rez<br>Desarrollador de software</h4>
                <p>Un Programador no se debe centrar solo en el conocimiento de una herramienta o un lenguaje de programaci??n en espec??fico, el verdadero talento de un ingeniero de sistemas es la habilidad de encontrar soluciones que otros no ven a alg??n problema</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="icon"><img src="images/common/success.png"  height="40px" alt="succes-icon"></div>
                        <div class="title">??Habilidades?</div>
                        <p>Programar es una habilidad que toma tiempo mejorar. Cada vez que programas, est??s desarrollando y mejorando tu l??gica</p>
                    </div>
                    <div class="col-md-6">
                        <div class="icon"><img src="images/common/success.png"  height="40px" alt="succes-icon"></div>
                        <div class="title">Legendary</div>
                        <p>El desarrollo es una profesi??n con altibajos, pero que al final del d??a te deja gran satisfacci??n de ver las capacidades que tienes de resolver problemas. </p>
                    </div>
                    <!-- <div class="col-md-12"><a href="trophies.html" class="booking">trophies</a></div>-->
                </div>
            </div>
            <div class="col-md-5 position-relative">
                <!-- <blockquote class="coach-quote">
                    <p>Austin mustache man bun vice helvetica.</p>
                    <p class="name">Brandon Campbell / head coach</p>

                </blockquote>-->
                <img class="img-responsive" src="images/soccer/evelio-ramirez.png" alt="coach-image">
            </div>
        </div>
    </div>  
</section>
<!--SUCCESS STORY END-->
@endsection