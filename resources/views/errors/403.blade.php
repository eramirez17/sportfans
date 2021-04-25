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
<section class="success-story sport">
    <div class="alert alert-danger">
        <h3>P&aacute;gina no autorizada.</h3>
    </div>      
</section>
<!--SUCCESS STORY END-->
@endsection