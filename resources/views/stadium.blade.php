@extends('layouts.web')
@section('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@endsection
@section('navbar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
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
                            <li>
                                <a href="{{ route('inicio') }}"><span>Home</span></a>
                            </li>
                            <li class="active">
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
 <!--BREADCRUMBS BEGIN-->
<section class="image-header">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="info">
                    <div class="wrap">
                        <ul class="breadcrumbs">
                            <li>Lista de/</li>
                            <li><a href="{{ route('stadiums') }}">Estadios</a></li>
                        </ul>
                        <h1>Estadios</h1>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</section>
<!--BREADCRUMBS END-->

<!--CLUB WRAP BEGIN-->

    <section class="club-wrap club-champ">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h4>{{$stadium->caption}}</h4>
                    <div class="champ-date">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <strong>Capacidad: </strong>{{$stadium->capacity}}
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('stadiums') }}" class="btn small club-top-btn">Volver</a>
                </div>
            </div>
        </div>
        
<div class="championship-header-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="club-logo">
                    <img class="img-thumbnail rounded" src="{{env('APP_URL')}}:8000/storage/stadiums/{{$stadium->picture}}" height="100px" alt="{{$stadium->caption}}">               
                </div>
            </div>
            <div class="col-md-3">
                <div class="club-info">
                    <div class="item"><strong>Equipos que juegan aqu&iacute;:</strong>
                        <ul>
                            @foreach($stadium->teams as $team)
                            <li>{{$team->caption}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="club-info">
                    <div class="item"> <strong> Sobre {{$stadium->caption}}</strong></div>
                    <p>{{$stadium->abstract}}</p>
                </div>  
            </div>
        </div>  
    </div>  
</div>
    </section>

    <!--CLUB WRAP END-->
@endsection