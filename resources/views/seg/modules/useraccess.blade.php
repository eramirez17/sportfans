<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Acceso a Módulos') }}
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
                            <hr/>
                            <h6>Filtrar Busqueda</h6>
                    {!! Form::open(['route' => ['useraccess',$module],'method'=>'GET','class'=>'form-inline text-right']) !!}
                        <div class="row">
                            <div class="col input-group text-right">
                                {{Form::text('id',null,['class'=>'form-control','placeholder'=>'ID'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::text('email',null,['class'=>'form-control','placeholder'=>'Email'])}}
                            </div>
                            <div class="col input-group text-right">
                                {{Form::select('profile_id',[''=>'Perfil',$profiles],null,['class'=>'form-control'])}}
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
                        {!! Form::open(['route' => ['saveaccess',$module],'enctype'=>'multipart/form-data']) !!}
                        <input type="hidden" name="module_id" value="{{$module->id}}">
                        <h4>Usuarios</h4>
                        <div class="container">
                            {{$users->render()}}
                          <div class="row gx-5">
                            @foreach($users as $user)
                                <div class="col-md-2 border alert">
                                  <strong>{{$user->name}}</strong>
                                  @if($user->modules->contains($module->id))
                                    @foreach($user->modules as $checkbox)
                                        @if($checkbox->id == $module->id)
                                             @if($checkbox->pivot->list == 1)
                                                <p>
                                                    <label>{{ Form::checkbox('list[]',$user->id ,true,['class'=>'form-check-input'] ) }} Listar</label>
                                                    </p>
                                             @else
                                                <p>
                                                    <label>{{ Form::checkbox('list[]',$user->id ,false,['class'=>'form-check-input'] ) }} Listar</label>
                                                    </p>
                                             @endif

                                             @if($checkbox->pivot->check == 1)
                                                <p>
                                                    <label>{{ Form::checkbox('check[]',$user->id,true,['class'=>'form-check-input'] ) }} Ver</label>
                                                    </p>
                                             @else
                                                <p>
                                                    <label>{{ Form::checkbox('check[]',$user->id,false,['class'=>'form-check-input'] ) }} Ver</label>
                                                    </p>
                                             @endif

                                             @if($checkbox->pivot->create == 1)
                                                <p>
                                                    <label>{{ Form::checkbox('create[]',$user->id,true,['class'=>'form-check-input'] ) }} Crear</label>
                                                    </p>
                                             @else
                                                <p>
                                                    <label>{{ Form::checkbox('create[]',$user->id,false,['class'=>'form-check-input'] ) }} Crear</label>
                                                    </p>
                                             @endif

                                             @if($checkbox->pivot->edit == 1)
                                                <p>
                                                    <label>{{ Form::checkbox('edit[]',$user->id ,true,['class'=>'form-check-input'] ) }} Editar</label>
                                                    </p>
                                             @else
                                                <p>
                                                    <label>{{ Form::checkbox('edit[]',$user->id ,false,['class'=>'form-check-input'] ) }} Editar</label>
                                                    </p>
                                             @endif

                                             @if($checkbox->pivot->delete == 1)
                                                <p>
                                                    <label>{{ Form::checkbox('delete[]',$user->id ,true,['class'=>'form-check-input'] ) }} Eliminar</label>
                                                    </p>
                                             @else
                                                <p>
                                                    <label>{{ Form::checkbox('delete[]',$user->id ,false,['class'=>'form-check-input'] ) }} Eliminar</label>
                                                    </p>
                                             @endif
                                        @endif
                                    @endforeach
                                  @else
                                    <p>
                                        <label>
                                            {{ Form::checkbox('list[]',$user->id,false,['class'=>'form-check-input'] ) }} Listar
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            {{ Form::checkbox('check[]',$user->id,false,['class'=>'form-check-input'] ) }} Ver
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            {{ Form::checkbox('create[]',$user->id,false,['class'=>'form-check-input'] ) }} Crear
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            {{ Form::checkbox('edit[]',$user->id,false,['class'=>'form-check-input'] ) }} Editar
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            {{ Form::checkbox('delete[]',$user->id,false,['class'=>'form-check-input'] ) }} Eliminar
                                        </label>
                                    </p>
                                  @endif
                                </div>
                            @endforeach
                          </div>
                          {{$users->render()}}
                        </div>
                        <hr/>
                        <div class="form-group">
                                {{Form::submit('Guardar',['class'=>'btn btn-sm btn-primary'])}}
                                <a href="{{route('modules.index')}}" class="btn btn-sm btn-secondary">
                                        volver
                                </a>
                            </div>
                        {!! Form::close() !!}
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>