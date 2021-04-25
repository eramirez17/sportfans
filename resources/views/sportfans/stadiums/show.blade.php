<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver Estadio') }}
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
                                <label>
                                    <strong>
                                        ID - Nombre:
                                    </strong>
                                </label>
                                {{$stadium->id}} - {{$stadium->caption}}
                            </p>
                            <p>
                                <label>
                                    <strong>
                                        Slug o url en sistema:
                                    </strong>
                                </label>
                                {{$stadium->slug}}
                            </p>
                        </div>
                        <div class="panel-body">
                            <p>
                                <label>
                                    <strong>
                                        Capacidad:
                                    </strong>
                                </label>
                                 {{$stadium->capacity}}
                             </p>
                            <p>
                                <label>
                                    <strong>
                                        Resumen:
                                    </strong>
                                </label>
                                <img src="{{env('APP_URL')}}:8000/storage/stadiums/{{$stadium->picture}}" class="img-thumbnail rounded" height="350px" width="350px">
                                {{$stadium->abstract}}
                             </p>
                             <hr/>
                             <p>
                                <label>
                                    <strong>
                                        Este estadio es sede de estos Equipos:
                                    </strong>
                                </label>
                                <div class="container">
                                    <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                                 @foreach($stadium->teams as $team)
                                        <div class="col">
                                            <div class="p-3 border bg-light">{{$team->caption}}</div>
                                        </div>
                                 @endforeach
                                    </div>
                                </div>
                            </p>
                            <hr/>
                            <a href="{{route('stadiums.edit',$stadium)}}" class="btn btn-sm btn-primary">
                                    Editar
                            </a>
                            <a href="{{route('stadiums.index')}}" class="btn btn-sm btn-secondary">
                                    volver
                            </a>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>