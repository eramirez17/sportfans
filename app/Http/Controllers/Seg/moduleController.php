<?php

namespace App\Http\Controllers\Seg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class moduleController extends Controller
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
        if (isset($permission['modules']['list']) && $permission['modules']['list']=== "1") {
            //obtener los datos del filtro de busqueda
            $id = $request->get('id');
            $caption = $request->get('caption');
            $paginate = ($request->get('paginate')) ? $request->get('paginate') : 10 ;

            $modules = Module::id($id)
                        ->caption($caption)
                        ->orderBy('id','desc')
                        ->paginate($paginate);
            return view('seg.modules.index',compact('modules'));
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
        if (isset($permission['modules']['create']) && $permission['modules']['create']=== "1") {
            return view('seg.modules.create');
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
        $module = Module::create([
            'caption' => $request->caption,
        ]);
        return redirect()->route('modules.show',compact('module')) 
            ->with('info','Registro actualizado con éxito');
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
        if (isset($permission['modules']['check']) && $permission['modules']['check']=== "1") {
            $module = Module::where('id',$id)->first();
            return view('seg.modules.show',compact('module'));
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
    public function edit(Module $module)
    {
        $permission = session('permissions');
        if (isset($permission['modules']['edit']) && $permission['modules']['edit']=== "1") {
            return view('seg.modules.edit',compact('module'));
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
        $module = Module::find($id);
        $module->caption = $request->caption;
        $module->save();
        return redirect()->route('modules.show',compact('module')) 
            ->with('info','Registro actualizado con éxito');
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
        if (isset($permission['modules']['delete']) && $permission['modules']['delete']=== "1") {
            $module = Module::find($id)->delete();
        return back()->with('info','Registro eliminado con éxito');
        } else {
            return view('errors.unauthorized');
        }

        
    }

    public function useraccess(Module $module, Request $request)
    {
        $permission = session('permissions');
        if (isset($permission['modules']['edit']) && $permission['modules']['edit']=== "1") {
            //obtener los datos del filtro de busqueda
            $id = $request->get('id');
            $name = $request->get('name');
            $email = $request->get('email');
            $profile_id = $request->get('profile_id');
            $paginate = ($request->get('paginate')) ? $request->get('paginate') : 10 ;
            $users = new User;
            if(isset($request)){
                $users = User::id($id)
                        ->name($name)
                        ->email($email)
                        ->profile_id($profile_id)
                        ->orderBy('id','desc')
                        ->paginate($paginate);    
            }
            $profiles = Profile::orderBy('caption','ASC')->pluck('caption','id');
            return view('seg.modules.useraccess',compact('module','users','profiles'));
        } else {
            return view('errors.unauthorized');
        }

        
    }

    public function saveaccess(Request $request)
    {
        //caso 1. usuarios que ya tienen permisos asignados a ese módulo
        $module = Module::id($request->module_id)->first();
        foreach ($module->users as $user) {
            $values = array();
            if (isset($request->list) && in_array($user->user_id,$request->list) ) {
                $values = array_merge($values,['list' => '1']);
            }else{
                $values = array_merge($values,['list' => '0']);
            }
            if (isset($request->check) && in_array($user->user_id,$request->check) ) {
                $values = array_merge($values,['check' => '1']);
            }else{
                $values = array_merge($values,['check' => '0']);
            }
            if (isset($request->create) && in_array($user->user_id,$request->create) ) {
                $values = array_merge($values,['create' => '1']);
            }else{
                $values = array_merge($values,['create' => '0']);
            }
            if (isset($request->edit) && in_array($user->user_id,$request->edit) ) {
                $values = array_merge($values,['edit' => '1']);
            }else{
                $values = array_merge($values,['edit' => '0']);
            }
            if (isset($request->delete) && in_array($user->user_id,$request->delete) ) {
                $values = array_merge($values,['delete' => '1']);
            }else{
                $values = array_merge($values,['delete' => '0']);
            }
            $values = DB::Table('module_user')->updateOrInsert(
                ['user_id' => $user->id, 'module_id' => $request->module_id],
                ['list' => $values['list'],'check' => $values['check'],'create' => $values['create'],'edit' => $values['edit'],'delete' => $values['delete']]
            );
        }
        //caso 2. estan en los arreglos. no se sabe si estan en la tabla
        $values = array();
        if (isset($request->list)){
            foreach ($request->list as $user) {
                $values = DB::Table('module_user')->updateOrInsert(
                                ['user_id' => $user, 'module_id' => $request->module_id],
                                ['list' => '1']
                            );
            }
        }
        
        if (isset($request->check)){
            foreach ($request->check as $user) {
                $values = DB::Table('module_user')->updateOrInsert(
                                ['user_id' => $user, 'module_id' => $request->module_id],
                                ['check' => '1']
                            );
            }
        }

        if (isset($request->create)){
            foreach ($request->create as $user) {
                $values = DB::Table('module_user')->updateOrInsert(
                                ['user_id' => $user, 'module_id' => $request->module_id],
                                ['create' => '1']
                            );
            }
        }

        if (isset($request->edit)){
            foreach ($request->edit as $user) {
                $values = DB::Table('module_user')->updateOrInsert(
                                ['user_id' => $user, 'module_id' => $request->module_id],
                                ['edit' => '1']
                            );
            }
        }

        if (isset($request->delete)){
            foreach ($request->delete as $user) {
                $values = DB::Table('module_user')->updateOrInsert(
                                ['user_id' => $user, 'module_id' => $request->module_id],
                                ['delete' => '1']
                            );
            }
        }
         $modules = Module::orderBy('id','desc')
                    ->paginate(10);

        //permisos para usuario en cada modulo
        $access = DB::Table('module_user')
                        ->where('user_id',Auth::user()->id)
                        ->get();
        $permissions = array();
        foreach ($access as $module) {
            $SM = Module::id($module->module_id)->first();            
            $permissions = array_merge($permissions,[
                                        $SM->caption=>[
                                            'list'=>$module->list,
                                            'check'=>$module->check,
                                            'create'=>$module->create,
                                            'edit'=>$module->edit,
                                            'delete'=>$module->delete]]);
        }
        session(['permissions'=> $permissions]);
        return view('seg.modules.index',compact('modules'));
    }
}
