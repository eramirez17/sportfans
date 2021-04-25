<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver Competición') }}
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
                                <img src="{{env('APP_URL')}}:8000/storage/competitions/{{$competition->logo}}" class="img-thumbnail rounded">
                                <label>
                                    <strong>
                                        ID - Nombre:
                                    </strong>
                                </label>
                                {{$competition->id}} - {{$competition->caption}}
                            </p>
                            <p>
                                <label>
                                    <strong>
                                        Slug o url en sistema:
                                    </strong>
                                </label>
                                {{$competition->slug}}
                            </p>
                        </div>
                        <div class="panel-body">
                            <p>
                                <label>
                                    <strong>
                                        Deporte:
                                    </strong>
                                </label>
                                <img src="{{env('APP_URL')}}:8000/storage/sports/{{$competition->sport->picture}}" class="img-thumbnail rounded" height="150px" width="150px">
                                 {{$competition->sport->caption}}
                             </p>
                             <p>
                                <label>
                                    <strong>
                                        Regi&oacute;n:
                                    </strong>
                                </label>
                                <img src="{{env('APP_URL')}}:8000/storage/regions/{{$competition->region->picture}}" class="img-thumbnail rounded" height="150px" width="150px">
                                 {{$competition->region->caption}}
                             </p>
                            <hr/>
                            <a href="{{route('competitions.edit',$competition)}}" class="btn btn-sm btn-primary">
                                    Editar
                            </a>
                            <a href="{{route('seasons.index')}}" class="btn btn-sm btn-success">
                                    Temporadas
                            </a>
                            <a href="{{route('competitions.index')}}" class="btn btn-sm btn-secondary">
                                    volver
                            </a>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>