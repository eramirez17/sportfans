<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Lista de Competiciones') }}
                    </h2>
                </div>
                <div class="col-sm text-right">
                    <a href="{{route('competitions.create')}}" class="btn btn-success btn-sm">
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
                    <div class="row">
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
                    {!! Form::open(['route' => ['competitions.index'],'method'=>'GET','class'=>'form-inline text-right']) !!}
                        <div class="row">
                            <div class="col input-group text-right">
                                {{Form::text('id',null,['class'=>'form-control','placeholder'=>'ID'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::text('caption',null,['class'=>'form-control','placeholder'=>'Nombre'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::select('sport_id',[''=>'Deporte',$sports],null,['class'=>'form-control'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::select('region_id',[''=>'Región',$regions],null,['class'=>'form-control'])}}
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
                    {{$competitions->render()}}
                    <table class="table table-success table-striped">
                        <thead>
                            <tr class="">
                              <th scope="col">#</th>
                              <th scope="col">Logo</th>
                              <th scope="col">Nombre</th>
                              <th scope="col">Deporte</th>
                              <th scope="col">Regi&oacute;n</th>
                              <th scope="col" colspan="3" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach($competitions as $competition)
                        <tr class="align-middle">
                            <td scope="row">
                                <a href="{{route('competitions.show',$competition)}}">
                                    {{$competition->id}}
                                </a>
                            </td>
                            <td scope="row">
                                    <a href="{{route('competitions.show',$competition)}}">
                                        <img src="{{env('APP_URL')}}:8000/storage/competitions/{{$competition->logo}}" class="img-thumbnail rounded" height="100px" width="100px">
                                    </a>
                            </td>
                            <td scope="row">
                                    <a href="{{route('competitions.show',$competition)}}">
                                        {{$competition->caption}}
                                    </a>
                            </td>
                            <td scope="row">
                                <a href="{{route('competitions.show',$competition)}}">
                                    {{$competition->sport->caption}}
                                </a>
                            </td>
                            <td scope="row">
                                <a href="{{route('competitions.show',$competition)}}">
                                    {{$competition->region->caption}}
                                </a>
                            </td>                            
                            <td scope="row" class="text-right">
                                <a href="{{route('competitions.edit',$competition)}}">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        Modificar
                                    </button>
                                </a>
                            </td>
                            <td scope="row"class="text-center">
                                <a href="{{route('seasons.index')}}">
                                    <button type="button" class="btn btn-success btn-sm">
                                        Temporadas
                                    </button>
                                </a>
                            </td>
                            <td scope="row"class="text-left">
                                {!! Form::open(['route' => ['competitions.destroy',$competition],'method'=>'DELETE']) !!}
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>
                                {!! Form::close() !!}
                            </td> 
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    {{$competitions->render()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>