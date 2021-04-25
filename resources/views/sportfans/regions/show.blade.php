<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver Región') }}
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
                                {{$region->id}} - {{$region->caption}}
                            </p>
                            <p>
                                <label>
                                    <strong>
                                        Slug o url en sistema:
                                    </strong>
                                </label>
                                {{$region->slug}}
                            </p>
                        </div>

                        <div class="panel-body">
                            @if($region->parent)
                                <p>
                                    <label>
                                        <strong>
                                            Regi&oacute;n Superior:
                                        </strong>
                                    </label>

                                     {{$region->parent->caption}}
                                 </p>
                             @endif
                            <p>
                                <label>
                                    <strong>
                                        Resumen:
                                    </strong>
                                </label>
                                <img src="{{env('APP_URL')}}:8000/storage/regions/{{$region->picture}}" class="img-thumbnail rounded" height="350px" width="350px">
                                {{$region->abstract}}
                             </p>
                            <hr/>
                            <a href="{{route('regions.edit',$region)}}" class="btn btn-sm btn-primary">
                                    Editar
                            </a>
                            <a href="{{route('regions.index')}}" class="btn btn-sm btn-secondary">
                                    volver
                            </a>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>