<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Lista de Temporadas') }}
                    </h2>
                </div>
                <div class="col-sm text-right">
                    <a href="{{route('seasons.create')}}" class="btn btn-success btn-sm">
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h6>Filtrar Busqueda</h6>
                    {!! Form::open(['route' => ['seasons.index'],'method'=>'GET','class'=>'form-inline text-right']) !!}
                        <div class="row">
                            <div class="col input-group text-right">
                                {{Form::text('id',null,['class'=>'form-control','placeholder'=>'ID'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::text('caption',null,['class'=>'form-control','placeholder'=>'Nombre'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::select('competition_id',[''=>'Competición',$competitions],null,['class'=>'form-control'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::date('start_date', \Carbon\Carbon::now())}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::date('end_date', \Carbon\Carbon::now())}}
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
                    {{$seasons->render()}}
                    <table class="table table-success table-striped">
                        <thead>
                            <tr class="">
                              <th scope="col">#</th>
                              <th scope="col">Competici&oacute;n</th>
                              <th scope="col">Temporada</th>
                              <th scope="col">Inicio</th>
                              <th scope="col">Fin</th>
                              <th scope="col">Estado</th>
                              <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach($seasons as $season)
                        <tr class="align-middle">
                            <td scope="row">
                                <a href="{{route('seasons.show',$season)}}">
                                    {{$season->id}}
                                </a>
                            </td>
                            <td scope="row">
                                    <a href="{{route('seasons.show',$season)}}">
                                        <img src="{{env('APP_URL')}}:8000/storage/competitions/{{$season->Competition->logo}}" class="img-thumbnail rounded" height="100px" width="100px">
                                        <span>{{$season->Competition->caption}}</span>
                                    </a>
                            </td>
                            <td scope="row">
                                    <a href="{{route('seasons.show',$season)}}">
                                        {{$season->caption}}
                                    </a>
                            </td>
                            <td scope="row">
                                <a href="{{route('seasons.show',$season)}}">
                                    {{$season->start_date}}
                                </a>
                            </td>
                            <td scope="row">
                                <a href="{{route('seasons.show',$season)}}">
                                    {{$season->end_date}}
                                </a>
                            </td>
                            <td scope="row">
                                <a href="{{route('seasons.show',$season)}}">
                                    @switch($season->status)
                                        @case("SET")
                                            Listo
                                        @break

                                        @case("STARTED")
                                            Iniciado
                                        @break

                                        @case("BREAK")
                                            En Receso
                                        @break

                                        @case("ENDED")
                                            Finalizado
                                        @break
                                    @endswitch
                                </a>
                            </td>                            
                            <!-- <td scope="row" class="text-right">
                                
                            </td>
                            <td scope="row" class="text-center">
                                
                            </td>-->
                            <td scope="row" class="text-center">
                                {!! Form::open(['route' => ['seasons.destroy',$season],'method'=>'DELETE']) !!}
                                    <a href="{{route('seasons.edit',$season)}}">
                                        <button type="button" class="btn btn-primary btn-sm">
                                            Modificar
                                        </button>
                                    </a>
                                    <a href="{{route('qualification',$season)}}">
                                        <button type="button" class="btn btn-success btn-sm">
                                            Participantes
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
                    {{$seasons->render()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>