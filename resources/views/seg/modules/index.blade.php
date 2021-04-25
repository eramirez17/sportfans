<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Módulos del sistema') }}
                    </h2>    
                </div>
                <div class="col-sm text-right">
                    <a href="{{route('modules.create')}}" class="btn btn-success btn-sm text-right">
                        Nuevo
                    </a>
                </div>
            </div>
        </div>
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

                @if(count($errors))
                    <div class="container">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                                {{session('info')}}    
                            </div>
                        </div>                
                    </div>        
                @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h6>Filtrar Busqueda</h6>
                    {!! Form::open(['route' => ['modules.index'],'method'=>'GET','class'=>'form-inline text-right']) !!}
                        <div class="row">
                            <div class="col input-group text-right">
                                {{Form::text('id',null,['class'=>'form-control','placeholder'=>'ID'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::text('caption',null,['class'=>'form-control','placeholder'=>'Nombre'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::text('abstract',null,['class'=>'form-control','placeholder'=>'Que la descripción contenga', 'maxlength'=>'15'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::select('paginate',['10'=>'10','20'=>'20','50'=>'50'],null,['class'=>'form-control'])}}
                            </div>
                            
                            <div class="col input-group text-right">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <hr/>
s                    {{$modules->render()}}
                    <table class="table table-success table-striped">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">T&iacute;tulo</th>
                              <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach($modules as $module)
                        <tr>
                            <td scope="row">
                                <a href="{{route('modules.show',$module->id)}}">
                                    {{$module->id}}
                                </a>
                            </td>
                            <td scope="row">
                                    <a href="{{route('modules.show',$module->id)}}">
                                        {{$module->caption}}
                                    </a>
                            </td>
                            <td scope="row"class="text-center">
                                
                                {!! Form::open(['route' => ['modules.destroy',$module->id],'method'=>'DELETE']) !!}
                                    <a href="{{route('modules.edit',$module)}}">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        Modificar
                                    </button>
                                </a>
                                <a href="{{route('useraccess',$module)}}">
                                    <button type="button" class="btn btn-success btn-sm">
                                        Asignar Acceso
                                    </button>
                                </a>
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>
                                {!! Form::close() !!}
                            </td> 
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    {{$modules->render()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>