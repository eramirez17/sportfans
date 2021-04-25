<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver Temporada') }}
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
                                        Competici&oacute;n:
                                    </strong>
                                </label>
                                <img src="{{env('APP_URL')}}:8000/storage/competitions/{{$season->competition->logo}}" class="img-thumbnail rounded" height="150px" width="150px">
                                 {{$season->competition->caption}}
                             </p>
                            <p>
                                <label>
                                    <strong>
                                        ID - Temporada:
                                    </strong>
                                </label>
                                {{$season->id}} - {{$season->caption}}
                            </p>
                            <p>
                                <label>
                                    <strong>
                                        Slug o url en sistema:
                                    </strong>
                                </label>
                                {{$season->slug}}
                            </p>
                        </div>
                        <div class="panel-body">
                             <p>
                                <label>
                                    <strong>
                                        Fecha de Inicio:
                                    </strong>
                                </label>
                                {{$season->start_date}}
                            </p>
                            <p>
                                <label>
                                    <strong>
                                        Fecha de Fin:
                                    </strong>
                                </label>
                                {{$season->end_date}}
                            </p>
                            <p>
                                <label>
                                    <strong>
                                        Cantidad de Participantes:
                                    </strong>
                                </label>
                                {{$season->quota}}
                            </p>
                            <p>
                                <label>
                                    <strong>
                                        Estatus:
                                    </strong>
                                </label>
                                @switch($season->status)
                                    @case ('SET')
                                        {{ __('Listo') }}
                                    @break
                                    @case ('STARTED')
                                        {{ __('Iniciado') }}
                                    @break
                                    @case ('BREAK')
                                        {{ __('En Receso') }}
                                    @break
                                    @case ('ENDED')
                                        {{ __('Culminado') }}
                                    @break
                                @endswitch
                            </p>
                             
                            <hr/>
                            <a href="{{route('seasons.edit',$season)}}" class="btn btn-sm btn-primary">
                                    Editar
                            </a>
                            <a href="{{route('qualification',$season)}}" class="btn btn-sm btn-success">
                                    Participantes
                            </a>
                            <a href="{{route('seasons.index')}}" class="btn btn-sm btn-secondary">
                                    volver
                            </a>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>