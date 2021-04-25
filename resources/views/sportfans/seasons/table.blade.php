<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clasificación') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('info'))
                        <div class="container">
                            <div class="row">
                                <div class="alert alert-success">
                                    {{session('info')}}    
                                </div>
                            </div>                
                        </div>        
                    @endif
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <p>
                                <label>
                                    
                                </label>
                                <img src="{{env('APP_URL')}}:8000/storage/competitions/{{$season->competition->logo}}" class="img-thumbnail rounded" height="150px" width="150px">
                                 <strong>
                                        Competici&oacute;n (Temporada):
                                    </strong>
                                    {{$season->competition->caption}} ({{$season->id}} - {{$season->caption}})
                            </p>
                        </div>
                        <div class="panel-body">                             
                            <hr/>
                            <div class="container"> 
                                <div class="row">
                                    <div class="col seasonteam overflow-auto">
                                        {!! Form::open(['route' => ['saveQual',$season],'enctype'=>'multipart/form-data']) !!}
                                        <input type="hidden" name="season_id" value="{{$season->id}}">
                                        <input type="hidden" name="quota" value="{{$season->quota}}">
                                        @for ($i = 0; $i < $season->quota; $i++)
                                            @switch($i)
                                                @case(0) 
                                                    <!--primer lugar-->
                                                    <div id="qua_{{($i+1)}}" class="alert alert-warning" ondrop="drop(event)" ondragover="allowDrop(event)">
                                                        <strong class="inline-block">{{($i+1)}}°</strong>
                                                        @if(isset($selected[$i]))
                                                        <input type="hidden" name="pos_{{($i+1)}}" id="pos_{{($i+1)}}" value="{{$selected[$i]['id']}}">
                                                        <div id="{{$selected[$i]['id']}}" draggable="true" ondragstart="drag(event)" class="text-center align-middle inline-block">
                                                            <img src="{{env('APP_URL')}}:8000/storage/teams/{{$selected[$i]['logo']}}" class="img-thumbnail rounded inline-block" height="50px" width="50px">
                                                            {{$selected[$i]['id']}} - {{$selected[$i]['caption']}}
                                                        </div>
                                                        @else
                                                            <input type="hidden" name="pos_{{($i+1)}}" id="pos_{{($i+1)}}">
                                                        @endif
                                                    </div>
                                                @break
                                                @case(1)
                                                    <!--segundo lugar-->
                                                    <div id="qua_{{($i+1)}}" class="alert alert-secondary" ondrop="drop(event)" ondragover="allowDrop(event)">
                                                        <strong>{{($i+1)}}°</strong>
                                                        @if(isset($selected[$i]))
                                                        <input type="hidden" name="pos_{{($i+1)}}" id="pos_{{($i+1)}}" value="{{$selected[$i]['id']}}">
                                                        <div id="{{$selected[$i]['id']}}" draggable="true" ondragstart="drag(event)" class="text-center align-middle inline-block">
                                                            <img src="{{env('APP_URL')}}:8000/storage/teams/{{$selected[$i]['logo']}}" class="img-thumbnail rounded inline-block" height="50px" width="50px">
                                                            {{$selected[$i]['id']}} - {{$selected[$i]['caption']}}
                                                        </div>
                                                        @else
                                                            <input type="hidden" name="pos_{{($i+1)}}" id="pos_{{($i+1)}}">
                                                        @endif
                                                    </div>
                                                @break
                                                @case(2)
                                                    <!--tercer lugar-->
                                                    <div id="qua_{{($i+1)}}" class="alert alert-danger" ondrop="drop(event)" ondragover="allowDrop(event)">
                                                        <strong>{{($i+1)}}°</strong>
                                                        @if(isset($selected[$i]))
                                                        <input type="hidden" name="pos_{{($i+1)}}" id="pos_{{($i+1)}}" value="{{$selected[$i]['id']}}">
                                                        <div id="{{$selected[$i]['id']}}" draggable="true" ondragstart="drag(event)" class="text-center align-middle inline-block">
                                                            <img src="{{env('APP_URL')}}:8000/storage/teams/{{$selected[$i]['logo']}}" class="img-thumbnail rounded inline-block" height="50px" width="50px">
                                                            {{$selected[$i]['id']}} - {{$selected[$i]['caption']}}
                                                        </div>
                                                        @else
                                                            <input type="hidden" name="pos_{{($i+1)}}" id="pos_{{($i+1)}}">
                                                        @endif
                                                    </div>
                                                @break
                                                @default
                                                    <!--el resto lugar-->
                                                    <div id="qua_{{($i+1)}}" class="alert border" ondrop="drop(event)" ondragover="allowDrop(event)">
                                                        <strong>{{($i+1)}}°</strong>
                                                        @if(isset($selected[$i]))
                                                        <input type="hidden" name="pos_{{($i+1)}}" id="pos_{{($i+1)}}" value="{{$selected[$i]['id']}}">
                                                        <div id="{{$selected[$i]['id']}}" draggable="true" ondragstart="drag(event)" class="text-center align-middle inline-block"> 
                                                        <img src="{{env('APP_URL')}}:8000/storage/teams/{{$selected[$i]['logo']}}" class="img-thumbnail rounded inline-block" height="50px" width="50px">
                                                            {{$selected[$i]['id']}} - {{$selected[$i]['caption']}}
                                                        </div>
                                                        @else
                                                            <input type="hidden" name="pos_{{($i+1)}}" id="pos_{{($i+1)}}">
                                                        @endif
                                                    </div>
                                            @endswitch
                                        @endfor
                                        
                                    </div>
                                    <div class="col seasonteam overflow-auto" ondrop="drop(event)" ondragover="allowDrop(event)">
                                        @foreach($unselected as $team)
                                            <div class="alert border">
                                                <div id="{{$team['id']}}" draggable="true" ondragstart="drag(event)" class="text-center align-middle inline-block">
                                                    <img src="{{env('APP_URL')}}:8000/storage/teams/{{$team['logo']}}" class="img-thumbnail rounded inline-block" height="50px" width="50px">
                                                    {{$team['id']}} - {{$team['caption']}}
                                                </div>
                                                    
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> 
                            <hr/>
                            <div class="form-group">
                                {{Form::submit('Guardar',['class'=>'btn btn-sm btn-primary'])}}
                                <a href="{{route('seasons.index')}}" class="btn btn-sm btn-secondary">
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
    <script>
        function allowDrop(ev) {
          ev.preventDefault();
        }

        function drag(ev) {
          ev.dataTransfer.setData("text", ev.target.id);
          //document.getElementById(ev.target.id);
          var hidden =  document.getElementById('pos_'+ev.target.parentElement.id);
            if (typeof(hidden) != 'undefined' && hidden != null)
            {
              hidden.value = "";
            }
        }

        function drop(ev) {
          ev.preventDefault();
          var data = ev.dataTransfer.getData("text");
          var hidden = 'pos_'+ev.target.id;
          ev.target.appendChild(document.getElementById(data));
          document.getElementById(hidden).value = data;
        }
    </script>
</x-app-layout>