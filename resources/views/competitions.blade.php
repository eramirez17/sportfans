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
                            <li>
                                <a href="{{ route('teams') }}"><span>Equipos</span></a>
                            </li>
                            <li class="active">
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
                            <li><a href="{{ route('competitions') }}">Ligas</a></li>
                        </ul>
                        <h1>Ligas</h1>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</section>
<!--BREADCRUMBS END-->

<!--STANDING TABLE WRAP BEGIN-->

    <section class="standing-table-wrap">
        
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <!-- <h4>Premier league</h4> -->
                    <div class="tab-filters">
                        {{$competitions->render()}}
                    </div>
                </div>
            </div>
        </div>

        <!--segunda version-->
        <div class="tab-item part-wrap tab-pane active" id="participants">
            <div class="part-list">
                <div class="container">
                    <div class="row">
                       <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- <h4>Premier league</h4> -->
                            <div class="item">
                                {!! Form::open(['route' => ['competitions'],'method'=>'GET','class'=>'form-inline row align-items-center']) !!}
                                    <div class="col align-middle">
                                        {{Form::text('caption',null,['class'=>'form-control','placeholder'=>'Nombre'])}}
                                    </div>
                                    <div class="col align-middle">
                                        {{Form::select('sport_id',[''=>'Deporte',$sports],null,['class'=>'form-control'])}}
                                    </div>
                                    <div class="col align-middle">
                                       {{Form::select('region_id',[''=>'Región',$regions],null,['class'=>'form-control'])}}
                                    </div>
                                    <div class="col align-middle">
                                        <button type="submit" class="btn ">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="part-list">
                <div class="container">
                    <div class="row">
                        @foreach($competitions as $competition)
                        <div class="col-md-3">
                            <a href="{{ route('competition',$competition->slug) }}" class="item">
                                <span class="logo"><img src="{{env('APP_URL')}}:8000/storage/competitions/{{$competition->logo}}" width="80" height="80" alt="team-logo"></span>
                                <span class="name">{{$competition->caption}}</span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
                    <p>Pabst irony tattooed, synth sriracha selvage pok pok. Wayfarers kinfolk sartorial, helvetica you probably haven't heard of them tumeric venmo deep v mixtape semiotics brunch.</p>
                </div>


    </section>

    <!--STANDING TABLE WRAP END-->
@endsection