<?php

namespace App\Http\Controllers\Sportfans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stadium;
use App\Models\Team;

class stadiumController extends Controller
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
        if (isset($permission['stadiums']['list']) && $permission['stadiums']['list']=== "1") {
            //obtener los datos del filtro de busqueda
            $id = $request->get('id');
            $caption = $request->get('caption');
            $capacity = $request->get('capacity');
            $paginate = ($request->get('paginate')) ? $request->get('paginate') : 10 ;
            $stadiums = Stadium::id($id)
                        ->caption($caption)
                        ->capacity($capacity)
                        ->orderBy('id','desc')->paginate($paginate);
            return view('sportfans.stadiums.index',compact('stadiums'));
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
        if (isset($permission['stadiums']['create']) && $permission['stadiums']['create']=== "1") {
            $stadium = new Stadium;
            $stadium->picture = "";
            return view('sportfans.stadiums.create',compact('stadium'));
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
        if ($request->file('picture')){
            $img = $request->slug.'.'.$request->file('picture')->extension();
            $request->file('picture')->storeAs('public/stadiums', $img);
        }
        $stadium = Stadium::create(['caption' => $request->caption,
            'abstract' => $request->abstract,
            'capacity' => $request->capacity,
            'slug' => $request->slug,
            'picture' => $img]);
               
        return redirect()->route('stadiums.show',$stadium)
            ->with('info','Registro creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stadium $stadium)
    {
        $permission = session('permissions');
        if (isset($permission['stadiums']['check']) && $permission['stadiums']['check']=== "1") {
            return view('sportfans.stadiums.show',compact('stadium'));
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
    public function edit(Stadium $stadium)
    {
        $permission = session('permissions');
        if (isset($permission['stadiums']['edit']) && $permission['stadiums']['edit']=== "1") {
            return view('sportfans.stadiums.edit',compact('stadium'));
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
        $stadium = Stadium::find($id);
        $stadium->caption = $request->caption;
        $stadium->abstract= $request->abstract;
        $stadium->capacity = $request->capacity;
        $stadium->slug = $request->slug;

        //almacenar imagen
        if ($request->file('picture')){
            $img = $request->slug.'.'.$request->file('picture')->extension();
            $request->file('picture')->storeAs('public/stadiums', $img);
            $stadium->picture = $img;    
        }        
        $stadium->save();
        return redirect()->route('stadiums.show',compact('stadium')) 
            ->with('info','Registro actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stadium $stadium)
    {
        $permission = session('permissions');
        if (isset($permission['stadiums']['delete']) && $permission['stadiums']['delete']=== "1") {
            $stadium = Stadium::find($stadium->id)->delete();
            return back()->with('info','Registro eliminado con éxito');
        } else {
            return view('errors.unauthorized');
        }

        
    }
}
