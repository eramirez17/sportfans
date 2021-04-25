<?php

namespace App\Http\Controllers\Sportfans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;

class regionController extends Controller
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
        if (isset($permission['regions']['list']) && $permission['regions']['list']=== "1") {
            $parentlist = Region::orderBy('caption','ASC')->pluck('caption','id');
            //obtener los datos del filtro de busqueda
            $id = $request->get('id');
            $caption = $request->get('caption');
            $parent_id = $request->get('parent_id');
            $paginate = ($request->get('paginate')) ? $request->get('paginate') : 10 ;

            $regions = Region::id($id)
                        ->caption($caption)
                        ->parent_id($parent_id)
                        ->orderBy('id','desc')->paginate($paginate);

            return view('sportfans.regions.index',compact('regions','parentlist'));
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
        if (isset($permission['regions']['create']) && $permission['regions']['create']=== "1") {
            $region = new Region;
            $region->picture = "";
            $parentlist = Region::orderBy('caption','ASC')->pluck('caption','id');
            return view('sportfans.regions.create',compact('region','parentlist'));
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
        if ($request->file('picture')){
            $img = $request->slug.'.'.$request->file('picture')->extension();
            $request->file('picture')->storeAs('public/regions', $img);
        }
        $region = Region::create(['caption' => $request->caption,
            'abstract' => $request->abstract,
            'parent_id' => $request->parent_id,
            'slug' => $request->slug,
            'external_link' => $request->external_link,
            'picture' => $img]);
               
        return redirect()->route('regions.show',$region)
            ->with('info','Registro creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        $permission = session('permissions');
        if (isset($permission['regions']['check']) && $permission['regions']['check']=== "1") {
            return view('sportfans.regions.show',compact('region'));
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
    public function edit(Region $region)
    {
        $permission = session('permissions');
        if (isset($permission['regions']['edit']) && $permission['regions']['edit']=== "1") {
            $parentlist = Region::orderBy('caption','ASC')->pluck('caption','id');
            return view('sportfans.regions.edit',compact('region','parentlist'));
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
        $region = Region::find($id);
        $region->caption        = $request->caption;
        $region->abstract       = $request->abstract;
        $region->parent_id      = $request->parent_id;
        $region->slug           = $request->slug;
        $region->external_link  = $request->external_link;

        //almacenar imagen
        if ($request->file('picture')){
            $img = $request->slug.'.'.$request->file('picture')->extension();
            $request->file('picture')->storeAs('public/regions', $img);
            $region->picture = $img;    
        }        
        $region->save();
        return redirect()->route('regions.show',compact('region')) 
            ->with('info','Registro actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $permission = session('permissions');
        if (isset($permission['regions']['delete']) && $permission['regions']['delete']=== "1") {
            $region = Region::find($region->id)->delete();
        return back()->with('info','Registro eliminado con éxito');
        } else {
            return view('errors.unauthorized');
        }


    }
}
