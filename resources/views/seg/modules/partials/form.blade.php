<div class="form-group">
	<strong>{{Form::label('id', 'ID.')}}</strong>
	{{Form::text('id',null,['class'=>'form-control','id'=>'id','readonly'=>'readonly'])}}
</div>
<div class="form-group">
	<strong>{{Form::label('caption', 'T&iacute;tulo')}}</strong>
	{{Form::text('caption',null,['class'=>'form-control','id'=>'caption'])}}
</div>
<hr/>
@if(isset($module))
<div class="form-group">
	<strong>{{Form::label('users', 'Usuarios con Acceso')}}</strong>
	<div class="container">
		<div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
			@foreach($module->users as $user)
				<label>
					<div class="col">
			            <div class="p-3 border bg-light">
								<strong>{{$user->name}}</strong>
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
				</label>
			@endforeach
		</div>
	</div>
</div>
<hr/>
@endif
<div class="form-group">
	{{Form::submit('Guardar',['class'=>'btn btn-sm btn-primary'])}}
	<a href="{{route('modules.index')}}" class="btn btn-sm btn-secondary">
            volver
    </a>
</div>