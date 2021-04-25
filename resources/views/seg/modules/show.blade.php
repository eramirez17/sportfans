<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Módulo del seguridad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             @if(session('info'))
                        <div class="container">
                            <div class="row">
                                <div class="alert alert-success">
                                    {{session('info')}}    
                                </div>
                            </div>                
                        </div>        
                    @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <p>
                                <label>
                                    <strong>
                                        ID - T&iacute;tulo:
                                    </strong>
                                </label>
                                {{$module->id}} - {{$module->caption}}
                            </p>
                        </div>
                        <div class="panel-body">
                             <p>
                                <label>
                                    <strong>
                                        Usuarios con Acceso:
                                    </strong>
                                </label>
                                <div class="container">
                                    <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                                 @foreach($module->users as $user)
                                        <div class="col">
                                            <div class="p-3 border bg-light">
                                                {{$user->name}}
                                                @if($user->pivot->list == 1)
                                    <p>
                                        <i class="fa fa-check" style="color:#4CAF50;"></i> Listar
                                    </p>
                                @else
                                    <p>
                                        <i class="fa fa-close" style="color:#FF0000;"></i> Listar
                                    </p>
                                @endif

                                @if($user->pivot->check == 1)
                                    <p>
                                        <i class="fa fa-check" style="color:#4CAF50;"></i> Ver
                                    </p>
                                @else
                                    <p>
                                        <i class="fa fa-close" style="color:#FF0000;"></i> Ver
                                    </p>
                                @endif

                                @if($user->pivot->create == 1)
                                    <p>
                                        <i class="fa fa-check" style="color:#4CAF50;"></i>Crear
                                    </p>
                                @else
                                    <p>
                                        <i class="fa fa-close" style="color:#FF0000;"></i> Crear
                                    </p>
                                @endif

                                @if($user->pivot->edit == 1)
                                    <p>
                                        <i class="fa fa-check" style="color:#4CAF50;"></i>Editar
                                    </p>
                                @else
                                    <p>
                                        <i class="fa fa-close" style="color:#FF0000;"></i> Editar
                                    </p>
                                @endif

                                @if($user->pivot->delete == 1)
                                    <p>
                                        <i class="fa fa-check" style="color:#4CAF50;"></i>Eliminar
                                    </p>
                                @else
                                    <p>
                                        <i class="fa fa-close" style="color:#FF0000;"></i> Eliminar
                                    </p>
                                @endif
                                            </div>
                                        </div>
                                 @endforeach
                                    </div>
                                </div>
                            </p>
                            <hr/>
                            <a href="{{route('modules.edit',$module)}}" class="btn btn-sm btn-primary">
                                    Editar
                            </a>
                            <a href="{{route('useraccess',$module)}}" class="btn btn-sm btn-success">
                                    Asignar a Usuarios
                            </a>
                            <a href="{{route('modules.index')}}" class="btn btn-sm btn-secondary">
                                    volver
                            </a>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>