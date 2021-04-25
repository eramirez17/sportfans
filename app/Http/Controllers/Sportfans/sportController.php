<?php

namespace App\Http\Controllers\Sportfans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sport;

class sportController extends Controller
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
        if (isset($permission['sports']['list']) && $permission['sports']['list']=== "1") {
            $id = $request->get('id');
            $caption = $request->get('caption');
            $paginate = ($request->get('paginate')) ? $request->get('paginate') : 10 ;
            $sports = Sport::id($id)
                        ->caption($caption)
                        ->orderBy('id','desc')->paginate($paginate);
            return view('sportfans.sports.index',compact('sports'));
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
        if (isset($permission['sports']['create']) && $permission['sports']['create']=== "1") {
            $sport = new Sport;
            $sport->picture = "";
            return view('sportfans.sports.create',compact('sport'));
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
        $img = "";
        if ($request->file('picture')){
            $img = $request->slug.'.'.$request->file('picture')->extension();
            $request->file('picture')->storeAs('public/sports', $img);
        }
        $sport = Sport::create(['caption' => $request->caption,
            'abstract' => $request->abstract,
            'capacity' => $request->capacity,
            'slug' => $request->slug,
            'picture' => $img]);
               
        return redirect()->route('sports.show',$sport)
            ->with('info','Registro creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sport $sport)
    {
        $permission = session('permissions');
        if (isset($permission['sports']['check']) && $permission['sports']['check']=== "1") {
            return view('sportfans.sports.show',compact('sport'));
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
    public function edit(Sport $sport)
    {
        $permission = session('permissions');
        if (isset($permission['sports']['edit']) && $permission['sports']['edit']=== "1") {
            return view('sportfans.sports.edit',compact('sport'));
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
        $sport = Sport::find($id);
        $sport->caption = $request->caption;
        $sport->slug = $request->slug;

        //almacenar imagen
        if ($request->file('picture')){
            $img = $request->slug.'.'.$request->file('picture')->extension();
            $request->file('picture')->storeAs('public/sports', $img);
            $sport->picture = $img;    
        }        
        $sport->save();
        return redirect()->route('sports.show',compact('sport')) 
            ->with('info','Registro actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sport $sport)
    {
        $permission = session('permissions');
        if (isset($permission['sports']['delete']) && $permission['sports']['delete']=== "1") {
            $sport = Sport::find($sport->id)->delete();
            return back()->with('info','Registro eliminado con éxito');
        } else {
            return view('errors.unauthorized');
        }


    }
}
