@extends('layouts.web')
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

<!--CLUB WRAP BEGIN-->

    <section class="club-wrap club-champ">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h4>{{$competition->caption}}</h4>
                    <div class="champ-date">
                        <i class="fa fa-futbol-o" aria-hidden="true"></i>
                        <strong>Deporte: </strong>{{$competition->sport->caption}}
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('competitions') }}" class="btn small club-top-btn">Volver</a>
                </div>
            </div>
        </div>
        
<div class="championship-header-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="club-logo">
                    <img src="{{env('APP_URL')}}:8000/storage/competitions/{{$competition->logo}}" class="img-responsive" alt="champ image" width="150px">                
                </div>
            </div>
            <div class="col-md-3">
                <div class="club-info">
                    <div class="item"><strong>Regi&oacute;n:</strong>
                        {{$competition->region->caption}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="club-info">
                    <div class="item"> <strong> Sobre {{$competition->caption}}</strong></div>
                    <p>{{$competition->abstract}}</p>
                </div>  
            </div>
        </div>
        <div class="row">
            <!--comienzo-->
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <h4>Temporadas</h4>
                    <ul class="tab-filters" role="tablist">
                        @foreach($seasons as $season)
                            <li>
                                <a href="#{{$season->slug}}" role="tab" data-toggle="tab">{{$season->caption}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 overflow-scroll standings-table"> 
                    <div class="tab-content">
                        @foreach($seasons as $season)
                            <div class="tab-pane fade" id="{{$season->slug}}" role="tabpanel">
                                    <table class="standing-full">
                                        <tr>
                                            <th>Pos</th>
                                            <th>Club</th>
                                            <th>Jugados</th>
                                            <th>Victorias</th>
                                            <th>Empates</th>
                                            <th>Derrotas</th>
                                            <th>DG</th>
                                            <th>Puntos</th>
                                            <th>Racha</th>
                                        </tr>
                                         @foreach($qualification as $position)
                                            @if($season->slug == $position['slug'])
                                                <tr>
                                                    <td class="up">
                                                        <i class="fa fa-caret-up" aria-hidden="true"></i> {{$position['position']}} 
                                                    </td>
                                                    <td class="text-left">
                                                        <span class="team"><img src="{{env('APP_URL')}}:8000/storage/teams/{{$position['logo']}}" width="30" height="30" alt="{{$position['caption']}}"> </span>{{$position['caption']}}
                                                    </td>
                                                    <td>11</td>
                                                    <td>8</td>
                                                    <td>2</td>
                                                    <td>1</td>
                                                    <td>+16</td>
                                                    <td class="points"><span>{{(100-$position['position'])}}</span></td>
                                                    <td class="form">
                                                        <span class="win">w</span>
                                                        <span class="drawn">d</span>
                                                        <span class="lose">l</span>
                                                        <span class="win">w</span>
                                                        <span class="win">w</span>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        
                                    </table>
                                </div>
                        @endforeach
                       
                    </div>
                </div>
            <!--fin-->
            
            
        </div>
        
</div>
    </section>

    <!--CLUB WRAP END-->
@endsection