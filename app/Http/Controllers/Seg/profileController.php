<?php

namespace App\Http\Controllers\Seg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;
use App\Models\Option;
use App\Models\Permission;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;

class profileController extends Controller
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
        if (isset($permission['profiles']['list']) && $permission['profiles']['list']=== "1") {
            //obtener los datos del filtro de busqueda
        $id = $request->get('id');
        $caption = $request->get('caption');
        $abstract = $request->get('abstract');
        $paginate = ($request->get('paginate')) ? $request->get('paginate') : 10 ;

        $profiles = Profile::id($id)
                    ->caption($caption)
                    ->abstract($abstract)
                    ->orderBy('id','desc')
                    ->paginate($paginate);
        return view('seg.profiles.index',compact('profiles'));
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
        if (isset($permission['profiles']['create']) && $permission['profiles']['create']=== "1") {
            $options = Option::orderBy('caption','ASC')->get();
            return view('seg.profiles.create',compact('options'));
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
    public function store(ProfileStoreRequest $request)
    {
        $request->validate([
            'caption' => 'required|string|max:50',
            'abstract' => 'required|string|max:255',
        ]);
        $profile = Profile::create($request->all());
        $profile->options()->sync($request->options);
        return redirect()->route('profiles.show',$profile)
            ->with('info','Registro creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = session('permissions');
        if (isset($permission['profiles']['check']) && $permission['profiles']['check']=== "1") {
            $profile = Profile::where('id',$id)->first();
            return view('seg.profiles.show',compact('profile'));
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
    public function edit(Profile $profile)
    {
        $permission = session('permissions');
        if (isset($permission['profiles']['edit']) && $permission['profiles']['edit']=== "1") {
            $options = Option::orderBy('caption','ASC')->get();
        return view('seg.profiles.edit',compact('profile','options'));
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
    public function update(ProfileUpdateRequest $request, $id)
    {
        $profile = Profile::find($id);
        $profile->fill($request->all())->save();
        $profile->options()->sync($request->options);
        return redirect()->route('profiles.show',compact('profile')) 
            ->with('info','Registro actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = session('permissions');
        if (isset($permission['profiles']['delete']) && $permission['profiles']['delete']=== "1") {
            $profile = Profile::find($id)->delete();
            return back()->with('info','Registro eliminado con éxito');
        } else {
            return view('errors.unauthorized');
        }

    }
}
