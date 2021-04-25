<?php

namespace App\Http\Controllers\Sportfans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Season;
use App\Models\Region;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class seasonController extends Controller
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
        if (isset($permission['seasons']['list']) && $permission['seasons']['list']=== "1") {
            //para listas en formulario de filtros
            $competitions = Competition::orderBy('caption','ASC')->pluck('caption','id');
            //obtener los datos del filtro de busqueda
            $id = $request->get('id');
            $caption = $request->get('caption');
            $competition_id = $request->get('sport_id');
            $start_date = $request->get('start_date');
            $end_date = $request->get('end_date');
            $paginate = ($request->get('paginate')) ? $request->get('paginate') : 10 ;
            $seasons = Season::id($id)
                        ->caption($caption)
                        ->competition_id($competition_id)
                        ->start_date($start_date)
                        ->end_date($end_date)
                        ->orderBy('id','desc')
                        ->paginate($paginate);
            return view('sportfans.seasons.index',compact('competitions','seasons'));
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
        if (isset($permission['seasons']['create']) && $permission['seasons']['create']=== "1") {
            $competitions = Competition::orderBy('caption','ASC')->pluck('caption','id');
            return view('sportfans.seasons.create',compact('competitions'));
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
        $season = Season::create([
            'caption' => $request->caption,
            'competition_id' => $request->competition_id,            
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'slug' => $request->slug,
            'status' => $request->status,
            'quota' => $request->quota,
        ]);
               
        return redirect()->route('seasons.show',$season)
            ->with('info','Registro creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Season $season)
    {
        $permission = session('permissions');
        if (isset($permission['seasons']['check']) && $permission['seasons']['check']=== "1") {
            return view('sportfans.seasons.show',compact('season'));
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
    public function edit(Season $season)
    {
        $permission = session('permissions');
        if (isset($permission['seasons']['edit']) && $permission['seasons']['edit']=== "1") {
            $competitions = Competition::orderBy('caption','ASC')->pluck('caption','id');
            return view('sportfans.seasons.edit',compact('competitions','season'));
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
    public function update(Request $request, Season $season)
    {
        $season = Season::find($season->id);
        $season->caption        = $request->caption;
        $season->competition_id = $request->competition_id;            
        $season->start_date     = $request->start_date;
        $season->end_date       = $request->end_date;
        $season->slug           = $request->slug;
        $season->status         = $request->status;
        $season->quota          = $request->quota;
        $season->save();
        return redirect()->route('seasons.show',compact('season')) 
            ->with('info','Registro actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Season $season)
    {
        $permission = session('permissions');
        if (isset($permission['seasons']['delete']) && $permission['seasons']['delete']=== "1") {
            $season = Season::find($season->id)->delete();
        return back()->with('info','Registro eliminado con éxito');
        } else {
            return view('errors.unauthorized');
        }

        
    }

    public function qualification(Season $season)
    {
        $permission = session('permissions');
        if (isset($permission['seasons']['edit']) && $permission['seasons']['edit']=== "1") {
            $teams = $this->getTeams($season->competition);
            $i=1;
            $selected = array();
            $unselected = array();
            $pos = DB::table('season_team')
                                ->select('position','team_id')
                                ->where('season_id',$season->id)
                                ->orderBy('position','asc')
                                ->get();
            foreach ($pos as $qua) {
                $position = $qua->position;
                    $team = Team::id($qua->team_id)->first();
                    $selected = array_merge($selected,[$position=>['id'=>$team->id,'caption'=>$team->caption,'logo'=>$team->logo,'position'=>$position]]);
            }
                    
            foreach ($teams as $team) {
                if (!($season->teams->contains($team->id))) {
                    $unselected = array_merge($unselected,array($i=>['id'=>$team->id,'caption'=>$team->caption,'logo'=>$team->logo]));
                }
                $i++;
            }
            return view('sportfans.seasons.table',compact('season','selected','unselected'));
        } else {
            return view('errors.unauthorized');
        }


    }

    public function saveQualification(Request $request, Season $season)
    {
        $qualification = DB::table('season_team')->where('season_id',$request->season_id)->delete();
        for ($i=1; $i <= $request->quota; $i++) { 
            $team_id = "pos_".$i;
            if ($request->$team_id > 0) {
                DB::table('season_team')->upsert([
                                    ['position'=>$i, 'season_id'=>$request->season_id, 'team_id'=>$request->$team_id]],
                                    ['team_id', 'season_id'],
                                    ['position']);
            }
        }
        return redirect()->route('seasons.index') 
            ->with('info','Registro actualizado con éxito');
    }

    public function getRegions($id)
    {
        $regions = Region::parent_id($id)->get();
        foreach ($regions as $child) {
            $id .= ','.$child->id;
            $children = Region::parent_id($child->id)->get();
            foreach ($children as $grandChild) {
                $id .= ','.$grandChild->id;
            }
        }
        return $id;
    }
    public function getTeams(Competition $competition)
    {
        $regions_id = $this->getRegions($competition->region_id);
        $team_id="";
        if (strpos($regions_id,',')>0) {
            $teams = Team::inRegion_id($regions_id)->get();
        }else{
            $teams = Team::region_id($regions_id)->get();
        }
        return $teams;
    }
}
