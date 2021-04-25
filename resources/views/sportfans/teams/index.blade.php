<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Lista de Equipos') }}
                    </h2>    
                </div>
                <div class="col-sm text-right">
                    <a href="{{route('teams.create')}}" class="btn btn-success btn-sm text-right">
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
                    {!! Form::open(['route' => ['teams.index'],'method'=>'GET','class'=>'form-inline text-right']) !!}
                        <div class="row">
                            <div class="col input-group text-right">
                                {{Form::text('id',null,['class'=>'form-control','placeholder'=>'ID'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::text('caption',null,['class'=>'form-control','placeholder'=>'Nombre'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::select('stadium_id',[''=>'Estadio Sede',$stadiums],null,['class'=>'form-control'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::select('sport_id',[''=>'Deporte',$sports],null,['class'=>'form-control'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::select('region_id',[''=>'Región',$regions],null,['class'=>'form-control'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::select('type',[''=>'Tipo de Equipo','club'=>'Club','nation'=>'Selección Nacional'],null,['class'=>'form-control'])}}
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
                    {{$teams->render()}}
                    <table class="table table-success table-striped">
                        <thead>
                            <tr class="">
                              <th scope="col">#</th>
                              <th scope="col">Escudo</th>
                              <th scope="col">Nombre</th>
                              <th scope="col">Estadio Sede</th>
                              <th scope="col">Deporte</th>
                              <th scope="col">Regi&oacute;n</th>
                              <th scope="col">Tipo de Equipo</th>
                              <th scope="col" colspan="2" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach($teams as $team)
                        <tr class="align-middle">
                            <td scope="row">
                                <a href="{{route('teams.show',$team)}}">
                                    {{$team->id}}
                                </a>
                            </td>
                            <td scope="row">
                                    <a href="{{route('teams.show',$team)}}">
                                        <img src="{{env('APP_URL')}}:8000/storage/teams/{{$team->logo}}" class="img-thumbnail rounded" height="100px" width="100px">
                                    </a>
                            </td>
                            <td scope="row">
                                    <a href="{{route('teams.show',$team)}}">
                                        {{$team->caption}}
                                    </a>
                            </td>
                            <td scope="row">
                                <a href="{{route('teams.show',$team)}}">
                                    {{$team->stadium->caption}}
                                </a>
                            </td>
                            <td scope="row">
                                <a href="{{route('teams.show',$team)}}">
                                    {{$team->sport->caption}}
                                </a>
                            </td>
                            <td scope="row">
                                <a href="{{route('teams.show',$team)}}">
                                    {{$team->region->caption}}
                                </a>
                            </td>
                            <td scope="row">
                                <a href="{{route('teams.show',$team)}}">
                                    @switch($team->type)
                                        @case('club')
                                            Club
                                        @break

                                        @case('nation')
                                            Selecci&oacute;n Nacional
                                        @break
                                    @endswitch
                                </a>
                            </td>
                            
                            <td scope="row" class="text-right">
                                <a href="{{route('teams.edit',$team)}}">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        Modificar
                                    </button>
                                </a>
                            </td>
                            <td scope="row"class="text-left">
                                {!! Form::open(['route' => ['teams.destroy',$team],'method'=>'DELETE']) !!}
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>
                                {!! Form::close() !!}
                            </td> 
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    {{$teams->render()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>