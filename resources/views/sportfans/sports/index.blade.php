<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Lista de Deportes') }}
                    </h2>
                </div>
                <div class="col-sm text-right">
                    <a href="{{route('sports.create')}}" class="btn btn-success btn-sm">
                                Nuevo
                        </a>    
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
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

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h6>Filtrar Busqueda</h6>
                    {!! Form::open(['route' => ['sports.index'],'method'=>'GET','class'=>'form-inline text-right']) !!}
                        <div class="row">
                            <div class="col input-group text-right">
                                {{Form::text('id',null,['class'=>'form-control','placeholder'=>'ID'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::text('caption',null,['class'=>'form-control','placeholder'=>'Nombre'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::select('paginate',[''=>'Líneas','10'=>'10','20'=>'20','50'=>'50'],null,['class'=>'form-control'])}}
                            </div>
                            
                            <div class="col input-group text-right">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <hr/>
                    {{$sports->render()}}
                    <table class="table table-success table-striped">
                        <thead>
                            <tr class="">
                              <th scope="col">#</th>
                              <th scope="col">Deporte</th>
                              <th scope="col">Logo</th>
                              <th scope="col" colspan="2" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach($sports as $sport)
                        <tr class="align-middle">
                            <td scope="row">
                                <a href="{{route('sports.show',$sport)}}">
                                    {{$sport->id}}
                                </a>
                            </td>
                            <td scope="row">
                                    <a href="{{route('sports.show',$sport)}}">
                                        {{$sport->caption}}
                                    </a>
                            </td>
                            <td scope="row">
                                    <a href="{{route('sports.show',$sport)}}">
                                        <img src="{{env('APP_URL')}}:8000/storage/sports/{{$sport->picture}}" class="img-thumbnail rounded" height="200px" width="200px">
                                    </a>
                            </td>
                            <td scope="row" class="text-right">
                                <a href="{{route('sports.edit',$sport)}}">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        Modificar
                                    </button>
                                </a>
                            </td>
                            <td scope="row"class="text-left">
                                {!! Form::open(['route' => ['sports.destroy',$sport],'method'=>'DELETE']) !!}
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>
                                {!! Form::close() !!}
                            </td> 
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    {{$sports->render()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>