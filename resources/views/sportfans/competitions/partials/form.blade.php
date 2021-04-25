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
	<strong>{{Form::label('abstract', 'Resumen')}}</strong>
	{{Form::textarea('abstract',null,['class'=>'form-control','id'=>'abstract','rows'=>'2'])}}
</div>
<div class="form-group">
	<strong>{{Form::label('sport_id', 'Deprote')}}</strong>
	{{Form::select('sport_id',$sports,null,['class'=>'form-control','id'=>'sport_id'])}}
</div>
<div class="form-group">
	<strong>{{Form::label('region_id', 'Región')}}</strong>
	{{Form::select('region_id',$regions,null,['class'=>'form-control','id'=>'region_id'])}}
</div>
<div class="form-group">
	<strong>{{Form::label('type', 'Tipo de Competici&oacute;nn')}}</strong>
	{{Form::select('type', [
	'club' => 'Clubes',
	 'nation' => 'Selecciones Nacionales',
	 ],['class'=>'form-control','id'=>'level'])}}
</div>
<div class="form-group">
	<strong>{{Form::label('logo', 'Logo o Escudo')}}</strong>
	@if($competition->logo)
		<img src="{{env('APP_URL')}}:8000/storage/competitions/{{$competition->logo}}" class="img-thumbnail rounded" height="350px" width="350px">
	@endif
	{{Form::file('logo',['class'=>'form-control','id'=>'picture'],null)}}
</div>
<hr/>
<div class="form-group">
	{{Form::submit('Guardar',['class'=>'btn btn-sm btn-primary'])}}
	<a href="{{route('competitions.index')}}" class="btn btn-sm btn-secondary">
            volver
    </a>
</div>