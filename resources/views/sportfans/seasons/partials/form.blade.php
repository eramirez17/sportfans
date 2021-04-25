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
	<strong>{{Form::label('competition_id', 'Competición')}}</strong>
	{{Form::select('competition_id',[''=>'---',$competitions],null,['class'=>'form-control'])}}
</div>
<div class="form-group">
	<strong>{{Form::label('start_date', 'Fecha de Arranque')}}</strong>
	{{Form::date('start_date', \Carbon\Carbon::now())}}
</div>
<div class="form-group">
	<strong>{{Form::label('end_date', 'Fecha de Culminación')}}</strong>
	{{Form::date('end_date', \Carbon\Carbon::now())}}
</div>
<div class="form-group">
	<strong>{{Form::label('quota', 'Cantidad de Participantes')}}</strong>
	{{Form::number('quota',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
	<strong>{{Form::label('status', 'Estado')}}</strong>
	{{Form::select('status', [
	'SET' => 'Listo',
	 'STARTED' => 'Iniciado',
	 'BREAK' => 'En Receso',
	 'ENDED' => 'Culminado'
	 ],['class'=>'form-control','id'=>'competition_status'])}}
</div>
<hr/>
<div class="form-group">
	{{Form::submit('Guardar',['class'=>'btn btn-sm btn-primary'])}}
	<a href="{{route('seasons.index')}}" class="btn btn-sm btn-secondary">
            volver
    </a>
</div>