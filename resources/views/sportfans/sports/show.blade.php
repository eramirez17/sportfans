<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver Deporte') }}
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
                                {{$sport->id}} - {{$sport->caption}}
                            </p>
                            <p>
                                <label>
                                    <strong>
                                        Slug o url en sistema:
                                    </strong>
                                </label>
                                {{$sport->slug}}
                            </p>
                        </div>
                        <div class="panel-body">
                            <p>
                                <label>
                                    <strong>
                                        Im&aacute;gen:
                                    </strong>
                                </label>
                                <img src="{{env('APP_URL')}}:8000/storage/sports/{{$sport->picture}}" class="img-thumbnail rounded" height="350px" width="350px">
                             </p>
                            <hr/>
                            <a href="{{route('sports.edit',$sport)}}" class="btn btn-sm btn-primary">
                                    Editar
                            </a>
                            <a href="{{route('sports.index')}}" class="btn btn-sm btn-secondary">
                                    volver
                            </a>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>