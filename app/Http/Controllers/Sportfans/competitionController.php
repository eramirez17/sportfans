<?php

namespace App\Http\Controllers\Sportfans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Region;
use App\Models\Sport;
use App\Models\Season;
use App\Models\Team;

class competitionController extends Controller
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
        if (isset($permission['competitions']['list']) && $permission['competitions']['list']=== "1") {
            //para listas en formulario de filtros
            $regions = Region::orderBy('caption','ASC')->pluck('caption','id');
            $sports = Sport::orderBy('caption','ASC')->pluck('caption','id');


            //obtener los datos del filtro de busqueda
            $id = $request->get('id');
            $caption = $request->get('caption');
            $sport_id = $request->get('sport_id');
            $region_id = $request->get('region_id');
            $paginate = ($request->get('paginate')) ? $request->get('paginate') : 10 ;

            $competitions = Competition::id($id)
                        ->caption($caption)
                        ->sport_id($sport_id)
                        ->region_id($region_id)
                        ->orderBy('id','desc')
                        ->paginate($paginate);
            return view('sportfans.competitions.index',compact('competitions','regions','sports'));
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
        if (isset($permission['competitions']['create']) && $permission['competitions']['create']=== "1") {
            $competition = new Competition;
            $competition->picture = "";
            $regions = Region::orderBy('caption','ASC')->pluck('caption','id');
            $sports = Sport::orderBy('caption','ASC')->pluck('caption','id');
            return view('sportfans.competitions.create',compact('competition','regions','sports'));
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
        //almacenar imagen
        $img="";
        if ($request->file('logo')){
            $img = $request->slug.'.'.$request->file('logo')->extension();
            $request->file('logo')->storeAs('public/competitions', $img);
        }
        $competition = Competition::create([
            'caption' => $request->caption,
            'sport_id' => $request->sport_id,            
            'abstract' => $request->abstract,
            'region_id' => $request->region_id,
            'slug' => $request->slug,
            'logo' => $img,
            'type' => $request->type,
        ]);
               
        return redirect()->route('competitions.show',$competition)
            ->with('info','Registro creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition)
    {
        $permission = session('permissions');
        if (isset($permission['competitions']['check']) && $permission['competitions']['check']=== "1") {
            return view('sportfans.competitions.show',compact('competition'));
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
    public function edit(Competition $competition)
    {
        $permission = session('permissions');
        if (isset($permission['competitions']['edit']) && $permission['competitions']['edit']=== "1") {
            $regions = Region::orderBy('caption','ASC')->pluck('caption','id');
        $sports = Sport::orderBy('caption','ASC')->pluck('caption','id');
        return view('sportfans.competitions.edit',compact('competition','regions','sports'));
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
        $competition = Competition::find($id);
        $competition->caption = $request->caption;
        $competition->sport_id= $request->sport_id;
        $competition->region_id = $request->region_id;
        $competition->abstract = $request->abstract;
        $competition->slug = $request->slug;
        $competition->type = $request->type;

        //almacenar imagen
        if ($request->file('logo')){
            $img = $request->slug.'.'.$request->file('logo')->extension();
            $request->file('logo')->storeAs('public/competitions', $img);
            $competition->logo = $img;    
        }        
        $competition->save();
        return redirect()->route('competitions.show',compact('competition')) 
            ->with('info','Registro actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        $permission = session('permissions');
        if (isset($permission['competitions']['delete']) && $permission['competitions']['delete']=== "1") {
            $competition = Competition::find($competition->id)->delete();
            return back()->with('info','Registro eliminado con éxito');
        } else {
            return view('errors.unauthorized');
        }

        
    }
}
