<div class="form-group">
	<strong>{{Form::label('id', 'ID.')}}</strong>
	{{Form::text('id',null,['class'=>'form-control','id'=>'id','readonly'=>'readonly'])}}
</div>
<div class="form-group">
	<strong>{{Form::label('caption', 'Nombre')}}</strong>
	{{Form::text('caption',null,['class'=>'form-control','id'=>'caption','onchange'=>"strToSlug('caption','slug')"])}}
</div>
<div class="form-group">
	<strong>{{Form::label('slug', 'Slug')}}</strong>
	{{Form::text('slug',null,['class'=>'form-control','id'=>'slug','readonly'=>'readonly'])}}
</div>
<div class="form-group">
	<strong>{{Form::label('capacity', 'Capacidad')}}</strong>
	{{Form::text('capacity',null,['class'=>'form-control','id'=>'capacity'])}}
</div>
<div class="form-group">
	<strong>{{Form::label('abstract', 'Resumen')}}</strong>
	{{Form::textarea('abstract',null,['class'=>'form-control','id'=>'abstract','rows'=>'2'])}}
</div>
<div class="form-group">
	<strong>{{Form::label('picture', 'Foto del estadio')}}</strong>
	@if($stadium->picture)
		<img src="{{env('APP_URL')}}:8000/storage/stadiums/{{$stadium->picture}}" class="img-thumbnail rounded" height="350px" width="350px">
	@endif
	{{Form::file('picture',['class'=>'form-control','id'=>'picture'],null)}}
</div>
<hr/>
<div class="form-group">
	{{Form::submit('Guardar',['class'=>'btn btn-sm btn-primary'])}}
	<a href="{{route('stadiums.index')}}" class="btn btn-sm btn-secondary">
            volver
    </a>
</div>