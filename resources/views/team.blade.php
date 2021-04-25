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
                            <li>
                                <a href="{{ route('inicio') }}"><span>Home</span></a>
                            </li>
                            <li>
                                <a href="{{ route('stadiums') }}"><span>Estadios</span></a>
                            </li>
                            <li class="active">
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
                            <li><a href="{{ route('teams') }}">Equipos</a></li>
                        </ul>
                        <h1>Equipos</h1>
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
                    <h4>{{$team->caption}}</h4>
                    <div class="champ-date">
                        <i class="fa fa-futbol-o" aria-hidden="true"></i>
                        <strong>Deporte: </strong>{{$team->sport->caption}}
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('teams') }}" class="btn small club-top-btn">Volver</a>
                </div>
            </div>
        </div>
        
<div class="championship-header-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="club-logo">
                    <img src="{{env('APP_URL')}}:8000/storage/teams/{{$team->logo}}" class="img-responsive" alt="champ image" width="300px">                
                </div>
            </div>
            <div class="col-md-3">
                <div class="club-info">
                    <div class="item"><strong>Informaci&oacute;n General:</strong>
                        <ul>
                            <li><strong>Regiones de participaci&oacute;n:</strong>
                                <ul>
                                    <li>{{$team->region->caption}}</li>
                                    @if($team->region->parent_id>0)
                                        <li>{{$team->region->parent->caption}}</li>
                                        @if($team->region->parent->parent_id>0)
                                            <li>{{$team->region->parent->parent->caption}}</li>
                                        @endif
                                    @endif
                                </ul>
                            </li>
                            <li><strong>Estadio Sede: </strong>{{$team->stadium->caption}}</li>
                            <li><strong>Club o Naci&oacute;n: </strong>
                                @if($team->type=='nation')
                                    Naci&oacute;n
                                @else
                                    Club
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="club-info">
                    <div class="item"> <strong> Palmar&eacute;s {{$team->caption}}</strong></div>
                    <p>pendiente sacar aqui las competiciones pasadas</p>
                </div>  
            </div>
        </div>  
    </div>  
</div>
    </section>

    <!--CLUB WRAP END-->
@endsection