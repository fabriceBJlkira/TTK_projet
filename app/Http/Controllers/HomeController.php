<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\TeamUser;
use App\Models\TeamMembre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EquipeRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UsersRepositories;
use App\Http\Requests\ProfilModifRequest;

class HomeController extends Controller
{
    private $userRepositories;

    public function __construct()
    {
        $this->userRepositories = new UsersRepositories();
    }

    public function home(Request $request)
    {
        $userProfile = User::where('id', session('LoggedUser'))->get();
        if (isset($request->logout)) {
            if (session()->has('LoggedUser')) {
                session()->pull('LoggedUser');
                return redirect('');
            }
        } else{

            return view(config('app.home'), [
                'users'=>$userProfile
            ]);
        }
    }
    public function joueur()
    {
        // dd(Auth::user()->name);
        $userProfile = User::where('id', session('LoggedUser'))->get();
        return view(config('app.joueur'),[
            'users' => $userProfile
        ]);
    }

    // profile
    public function profil()
    {
        $userProfile = User::where('id', session('LoggedUser'))->get();
        // dd($userProfile);
        return view(config('app.profil'), [
            'users'=>$userProfile,
        ]);
    }
    public function modificationProfile()
    {
        $userProfile = User::where('id', session('LoggedUser'))->get();

        return view(config('app.modifierprofile'), [
            'users'=>$userProfile,
        ]);
    }
    public function modificationProfilePost(ProfilModifRequest $request)
    {
        $request->validated();
        $this->userRepositories->modifusers($request);
        return redirect(config('app.profil1'));
    }

    // team
    public function teams($id)
    {

        $userProfile = User::where('id', session('LoggedUser'))->get();
        $groupe = Team::findOrFail($id);
        $pivot = TeamUser::where('team_id', $groupe->id)->where('user_id', session('LoggedUser'))->first();
        // dd($pivot);
        return view(config('app.team'), [
            'users' =>$userProfile,
            'groupes' =>$groupe,
            'pivots' =>$pivot
        ]);
    }
    public function teamsCreate()
    {
        $userProfile = User::where('id', session('LoggedUser'))->get();
        return view('components.createEquipe', [
            'users' =>$userProfile,
        ]);
    }
    public function rechercheTeam()
    {
        $userProfile = User::where('id', session('LoggedUser'))->get();
        $team = Team::paginate(9);
        $pivot = TeamUser::where('user_id', session('LoggedUser'))->get();
        // dd($pivot);
        return view('components.searchEquipe', [
            'users' =>$userProfile,
            'teams'=> $team,
            'pivots'=> $pivot
        ]);
    }
    public function adesion(Request $request)
    {
        $this->userRepositories->adesion($request);
        return back();
    }
    public function teamCreatePost(EquipeRequest $request)
    {
        $request->validated();
        $this->userRepositories->createEquipe($request);
        return redirect('home#equipe')->with('cree', 'votre equipe est bien crée admin');
    }

    // logout
    public function logout()
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('');
        }
    }
}
