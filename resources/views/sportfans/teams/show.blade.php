<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver Equipo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('info'))
                        <div class="container">
                            <div class="row">
                                <div class="alert alert-success">
                                    {{session('info')}}    
                                </div>
                            </div>                
                        </div>        
                    @endif
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <p>
                                <img src="{{env('APP_URL')}}:8000/storage/teams/{{$team->logo}}" class="img-thumbnail rounded" height="350px" width="350px">
                                <label>
                                    <strong>
                                        ID - Nombre:
                                    </strong>
                                </label>
                                {{$team->id}} - {{$team->caption}}
                            </p>
                            <p>
                                <label>
                                    <strong>
                                        Slug o url en sistema:
                                    </strong>
                                </label>
                                {{$team->slug}}
                            </p>
                        </div>
                        <div class="panel-body">
                            <p>
                                <label>
                                    <strong>
                                        Deporte:
                                    </strong>
                                </label>
                                <img src="{{env('APP_URL')}}:8000/storage/sports/{{$team->sport->picture}}" class="img-thumbnail rounded" height="150px" width="150px">
                                 {{$team->sport->caption}}
                             </p>
                             <p>
                                <label>
                                    <strong>
                                        Regi&oacute;n:
                                    </strong>
                                </label>
                                <img src="{{env('APP_URL')}}:8000/storage/regions/{{$team->region->picture}}" class="img-thumbnail rounded" height="150px" width="150px">
                                 {{$team->region->caption}}
                             </p>
                             <p>
                                <label>
                                    <strong>
                                        Estadio Sede:
                                    </strong>
                                </label>
                                <img src="{{env('APP_URL')}}:8000/storage/stadiums/{{$team->stadium->picture}}" class="img-thumbnail rounded" height="150px" width="150px">
                                 {{$team->stadium->caption}}
                             </p>
                            <p>
                                <label>
                                    <strong>
                                        Tipo de Equipo:
                                    </strong>
                                </label>
                                @switch($team->type)
                                    @case('club')
                                        Club
                                    @break
                                    @case('nation')
                                        Selecci&oacute;n Nacional
                                    @break
                                @endswitch
                             </p>
                            <hr/>
                            <a href="{{route('teams.edit',$team)}}" class="btn btn-sm btn-primary">
                                    Editar
                            </a>
                            <a href="{{route('teams.index')}}" class="btn btn-sm btn-secondary">
                                    volver
                            </a>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>