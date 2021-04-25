<?php

namespace App\Http\Controllers\Seg;

use App\Models\Option;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\OptionStoreRequest;
use App\Http\Requests\OptionUpdateRequest;
use App\Http\Controllers\Controller;

class optionController extends Controller
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
        if (isset($permission['options']['list']) && $permission['options']['list']=== "1") {
            $parentlist = Option::orderBy('caption','ASC')->pluck('caption','id');
            //obtener los datos del filtro de busqueda
            $id = $request->get('id');
            $caption = $request->get('caption');
            $abstract = $request->get('abstract');
            $parent_id = $request->get('parent_id');
            $paginate = ($request->get('paginate')) ? $request->get('paginate') : 10 ;
            $options = Option::id($id)
                        ->caption($caption)
                        ->abstract($abstract)
                        ->parent_id($parent_id)
                        ->orderBy('id','desc')
                        ->paginate($paginate);
            return view('seg.options.index',compact('options','parentlist'));
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
        if (isset($permission['options']['create']) && $permission['options']['create']=== "1") {
            $parentlist = Option::orderBy('caption','ASC')->pluck('caption','id');
        $profiles = Profile::orderBy('caption','ASC')->get();
        return view('seg.options.create',compact('profiles','parentlist'));
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
        $option = Option::create($request->all());
        $option->profiles()->sync($request->profiles);
        return redirect()->route('options.show',compact('option'))
            ->with('info','Registro creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        $permission = session('permissions');
        if (isset($permission['options']['check']) && $permission['options']['check']=== "1") {
            return view('seg.options.show',compact('option'));
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
    public function edit(Option $option)
    {
        $permission = session('permissions');
        if (isset($permission['options']['edit']) && $permission['options']['edit']=== "1") {
            $parentlist = Option::orderBy('caption','ASC')->pluck('caption','id');
            $profiles = Profile::orderBy('caption','ASC')->get();

            return view('seg.options.edit',compact('option','parentlist','profiles'));
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
    public function update(OptionUpdateRequest $request, Option $option)
    {
        $option = Option::find($option->id);
        $option->fill($request->all())->save();
        $option->profiles()->sync($request->profiles);
        return redirect()->route('options.show',compact('option')) 
            ->with('info','Registro actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        $permission = session('permissions');
        if (isset($permission['options']['delete']) && $permission['options']['delete']=== "1") {
            $option = Option::find($option->id)->delete();
            return back()->with('info','Registro eliminado con éxito');
        } else {
            return view('errors.unauthorized');
        }

        
    }
}
