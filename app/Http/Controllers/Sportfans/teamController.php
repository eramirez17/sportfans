<?php

namespace App\Http\Controllers\Sportfans;

use App\Models\Team;
use App\Models\Sport;
use App\Models\Region;
use App\Models\Stadium;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class teamController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permission = session('permissions');
        if (isset($permission['teams']['list']) && $permission['teams']['list']=== "1") {
            //datos para listas del formulario de busqueda filtrada
            $stadiums = Stadium::orderBy('caption','ASC')->pluck('caption','id');
            $regions = Region::orderBy('caption','ASC')->pluck('caption','id');
            $sports = Sport::orderBy('caption','ASC')->pluck('caption','id');
            
            //obtener los datos del filtro de busqueda
            $id = $request->get('id');
            $caption = $request->get('caption');
            $stadium_id = $request->get('stadium_id');
            $sport_id = $request->get('sport_id');
            $region_id = $request->get('region_id');
            $type = $request->get('type');
            $paginate = ($request->get('paginate')) ? $request->get('paginate') : 10 ;

            $teams = Team::id($id)
                        ->caption($caption)
                        ->sport_id($sport_id)
                        ->stadium_id($stadium_id)
                        ->region_id($region_id)
                        ->type($type)
                        ->orderBy('id','desc')
                        ->paginate($paginate);

            return view('sportfans.teams.index',compact('teams','stadiums','sports','regions'));
        } else {
            return view('errors.unauthorized');
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = session('permissions');
        if (isset($permission['teams']['create']) && $permission['teams']['create']=== "1") {
            $team = new Team;
            $team->picture = "";
            $regions = Region::orderBy('caption','ASC')->pluck('caption','id');
            $sports = Sport::orderBy('caption','ASC')->pluck('caption','id');
            $stadiums = Stadium::orderBy('caption','ASC')->pluck('caption','id');
            return view('sportfans.teams.create',compact('team','regions','sports','stadiums'));
        } else {
            return view('errors.unauthorized');
        }

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $img = "";
        //almacenar imagen
        if ($request->file('logo')){
            $img = $request->slug.'.'.$request->file('logo')->extension();
            $request->file('logo')->storeAs('public/teams', $img);
        }
        $stadium = Team::create([
            'caption' => $request->caption,
            'sport_id' => $request->sport_id,
            'stadium_id' => $request->stadium_id,
            'region_id' => $request->region_id,
            'slug' => $request->slug,
            'logo' => $img,
            'type' => $request->type
        ]);
               
        return redirect()->route('teams.show',$stadium)
            ->with('info','Registro creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        $permission = session('permissions');
        if (isset($permission['teams']['check']) && $permission['teams']['check']=== "1") {
            return view('sportfans.teams.show',compact('team'));
        } else {
            return view('errors.unauthorized');
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $permission = session('permissions');
        if (isset($permission['teams']['edit']) && $permission['teams']['edit']=== "1") {
            $regions = Region::orderBy('caption','ASC')->pluck('caption','id');
            $sports = Sport::orderBy('caption','ASC')->pluck('caption','id');
            $stadiums = Stadium::orderBy('caption','ASC')->pluck('caption','id');
            return view('sportfans.teams.edit',compact('team','regions','sports','stadiums'));
        } else {
            return view('errors.unauthorized');
        }

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $team = Team::find($id);
        $team->caption = $request->caption;
        $team->sport_id= $request->sport_id;
        $team->region_id = $request->region_id;
        $team->stadium_id = $request->stadium_id;
        $team->type = $request->type;
        $team->slug = $request->slug;

        //almacenar imagen
        if ($request->file('logo')){
            $img = $request->slug.'.'.$request->file('logo')->extension();
            $request->file('logo')->storeAs('public/teams', $img);
            $team->logo = $img;    
        }        
        $team->save();
        return redirect()->route('teams.show',compact('team')) 
            ->with('info','Registro actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $permission = session('permissions');
        if (isset($permission['teams']['delete']) && $permission['teams']['delete']=== "1") {
            $team = Team::find($team->id)->delete();
            return back()->with('info','Registro eliminado con éxito');
        } else {
            return view('errors.unauthorized');
        }


    }
}
