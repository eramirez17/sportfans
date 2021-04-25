<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Option;
use App\Models\Module;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        //para hacer menu de seguridad
        $root = array();
        $node = array();
        $child = array();

        //raiz del menu de navegacion
        $roots = Option::join('option_profile','options.id','option_profile.option_id')
                        ->where('level','root')
                        ->where('profile_id',Auth::user()->profile_id)
                        ->select('options.id','caption','link')->get();
        foreach ($roots as $item) {
            $active = explode('.',$item->link);
            $active = $active[0];
            $count = Option::where('parent_id',$item->id)->count();
            $root = ($count>0) ? array_merge($root,[$item->id=>['id'=>$item->id,'caption'=>$item->caption,'isParent'=>true,'link'=>$item->link,'active'=>$active]]) : array_merge($root,[$item->id=>['id'=>$item->id,'caption'=>$item->caption,'isParent'=>false,'link'=>$item->link,'active'=>$active]]) ;
        }

        //nodos del menu de navegacion
        $nodes = Option::join('option_profile','options.id','option_profile.option_id')
                        ->where('level','node')
                        ->where('profile_id',Auth::user()->profile_id)
                        ->select('parent_id','options.id','caption','link')->get();
        foreach ($nodes as $item) {
            $active = explode('.',$item->link);
            $active = $active[0];
            $count = Option::where('parent_id',$item->id)->count();
            $node = ($count>0) ? array_merge($node,[$item->id=>['id'=>$item->id,'parent_id'=>$item->parent_id,'caption'=>$item->caption,'isParent'=>true,'link'=>$item->link,'active'=>$active]]) : array_merge($node,[$item->id=>['id'=>$item->id,'parent_id'=>$item->parent_id,'caption'=>$item->caption,'isParent'=>false,'link'=>$item->link,'active'=>$active]]) ;
        }

        //ultimos hijos del menu de navegacion
        $children = Option::join('option_profile','options.id','option_profile.option_id')
                        ->where('level','child')
                        ->where('profile_id',Auth::user()->profile_id)
                        ->select('parent_id','options.id','caption','link')->get();
        foreach ($children as $item) {
            $active = explode('.',$item->link);
            $active = $active[0];
            $child = array_merge($child,[$item->id=>['id'=>$item->id,'parent_id'=>$item->parent_id,'caption'=>$item->id,'isParent'=>false,'link'=>$item->link,'active'=>$active]]) ;
        }
        session(['menuroot'=> $root,'menunode'=> $node,'menuchild'=> $child]);
        //fin de menu de seguridad

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
        //fin de permisos de usuario a cada modulo
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
