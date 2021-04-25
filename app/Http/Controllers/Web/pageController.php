<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\changePasswordRequest;
use App\Http\Requests\changeEmailRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Stadium;
use App\Models\Team;
use App\Models\Competition;
use App\Models\Region;
use App\Models\Sport;
use App\Models\Season;
use Illuminate\Support\Facades\DB;

class pageController extends Controller
{
    public function inicio() {
    	return view('welcome');
	}
	//actualiza los datos generales del usuario en sesion
	//marzo 2021. evelio ramirez
	public function savemyinfo(changePasswordRequest $request) {
		switch ($request->form) {
			case 'password':
				if (isset($request->password)>=8 && $request->password===$request->password_confirmation ) {
					$user = User::find($request->id);
					$password = Hash::make($request->password);
					$user->password = $password;
			        $user->save();
			    	$info = 'Contraseña actualizada con éxito';
				} else {
			    	$info ='Cambio no realizado: Alguna de las contraseñas estaba vacia o no coincidia';
				}
			break;
			
			default:
				$user = User::find($request->id);
				$save = false;
	            if (strlen($request->password)<=0) {
	                $password = $user->password;
	                $info = "Datos actualizados con éxito.";
	                $save = true;
	            }else{
	            	if (strlen($request->password)>=8 && $request->password===$request->password_confirmation ){
	            		$password = Hash::make($request->password);
	            		if (strlen($request->name)>0 && strlen($request->email)>0) {
	            			$save = true;
	            			$info = "Datos actualizados con éxito.";
	            		}else{
	            			$save = false;
	            			$info = "Datos no actualizados. Nombre o email vacios";
	            		}
	            	}else{
	            		$info = "Datos no actualizados. Alguna de las contraseñas estaba vacia o no coincidia";
	            	}
	            }
	            if ($save){
	            	$password = $password;
		            $user->name = $request->name;
				    $user->email = $request->email;
				    $user->password = $password;
				    $user->save();	
	            }
			break;
		}
		return view('dashboard')
    				->with('info',$info);
	}
	//vistas en el sitio web. sin autenticacion
	public function stadiums(Request $request) {
		$caption = $request->get('caption');
        $capacity = $request->get('capacity');
         $stadiums = Stadium::caption($caption)
                    ->capacity($capacity)
                    ->orderBy('caption','asc')->paginate(12);
    	return view('stadiums',compact('stadiums'));
	}
	public function stadium($slug) {
		$stadium = Stadium::where('slug',$slug)->first();
    	return view('stadium',compact('stadium'));
	}
	public function teams(Request $request) {
		$sport_id = $request->get('sport_id');
        $region_id = $request->get('region_id');
        $type = $request->get('type');
		$teams = Team::sport_id($sport_id)
                    ->region_id($region_id)
                    ->type($type)
                    ->orderBy('caption','ASC')
                    ->paginate(12);
		$regions = Region::orderBy('caption','ASC')->pluck('caption','id');
		$sports = Sport::orderBy('caption','ASC')->pluck('caption','id');
    	return view('teams',compact('teams','regions','sports'));
	}
	public function team($slug) {
		$team = Team::where('slug',$slug)->first();
    	return view('team',compact('team'));
	}
	public function competitions(Request $request) {
		$regions = Region::orderBy('caption','ASC')->pluck('caption','id');
		$sports = Sport::orderBy('caption','ASC')->pluck('caption','id');

		$sport_id = $request->get('sport_id');
        $region_id = $request->get('region_id');
        $caption = $request->get('caption');



		$competitions = Competition::sport_id($sport_id)
                    ->region_id($region_id)
                    ->caption($caption)
                    ->orderBy('caption','asc')->paginate(12);		
    	return view('competitions',compact('competitions','regions','sports'));
	}
	public function competition($slug) {
		$competition = Competition::where('slug',$slug)->first();
		$seasons = Season::where('competition_id',$competition->id)
						->orderBy('caption','desc')
						->get();
		$qualification = array();
		$i = 0;
		foreach ($seasons as $Season) {
			$table = DB::table('season_team')
                            ->select('position','team_id')
                            ->where('season_id',$Season->id)
                            ->orderBy('position','asc')
                            ->get();
            foreach ($table as $pos) {
	            $position = $pos->position;
	            $team = Team::id($pos->team_id)->first();
	            $qualification = array_merge($qualification,[$i=>['position'=>$position,'id'=>$team->id,'caption'=>$team->caption,'logo'=>$team->logo,'position'=>$position,'slug'=>$Season->slug]]);
	        }
		}
		$active = "";
    	return view('competition',compact('competition','seasons','qualification','active'));
	}
	//para eliminar la sesion cuando exista un error en la carga del menu de navegacion
	//01-04-21
	public function sessionDestroy() {
		Auth::guard('web')->logout();

        //$request->session()->invalidate();

        //$request->session()->regenerateToken();

        return redirect('/');
	}
}
