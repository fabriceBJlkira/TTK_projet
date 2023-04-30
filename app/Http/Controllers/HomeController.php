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
use Illuminate\Support\Facades\Hash;
use App\Repositories\UsersRepositories;
use App\Http\Requests\ProfilModifRequest;
use App\Models\Games;
use Termwind\Components\Dd;

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
        $game = Games::all();
        $groupe = Team::where('user_id', session('LoggedUser'))->get();
        // dd($groupe);

        return view(config('app.modifierprofile'), [
            'users'=>$userProfile,
            'games'=>$game,
            'groupes'=>$groupe
        ]);
    }
    public function modificationProfilePost(ProfilModifRequest $request)
    {
        $request->validated();
        $this->userRepositories->modifusers($request);
        if (session()->has('fail')) {
            return back()->with('fail', 'Email ou mot de passe incorect');
        }
        return redirect(config('app.profil1'));
    }

    public function modificationgameProfilepost(Request $request)
    {
        dd($request->all());
    }

    // team
    public function teams($id)
    {
        $userProfile = User::where('id', session('LoggedUser'))->get();
        $groupe = Team::findOrFail($id);
        $pivot = TeamUser::where('team_id', $groupe->id)->where('user_id', session('LoggedUser'))->first();
        $allMembre = DB::select('SELECT * FROM team_user INNER JOIN users ON (team_user.user_id = users.id) WHERE team_id ='.$groupe->id);
        // dd($allMembre);
        return view(config('app.team'), [
            'users' =>$userProfile,
            'groupes' =>$groupe,
            'pivots' =>$pivot,
            'allmembre' => $allMembre
        ]);
    }
    public function teamsCreate()
    {
        $userProfile = User::where('id', session('LoggedUser'))->get();
        return view('components.createEquipe', [
            'users' =>$userProfile,
        ]);
    }
    public function rechercheTeam(Request $request)
    {
        $userProfile = User::where('id', session('LoggedUser'))->get();
        $team = Team::paginate(9);
        $pivot = TeamUser::where('user_id', session('LoggedUser'))->get();
        // dd($pivot);
        if (isset($request->groupe)) {
            $search = Team::where('name','LIKE', $request->groupe)->paginate(9);
            return view('components.searchEquipe', [
                'users' =>$userProfile,
                'search'=> $search,
                'pivots'=> $pivot
            ]);
        } else {
            return view('components.searchEquipe', [
                'users' =>$userProfile,
                'teams'=> $team,
                'pivots'=> $pivot
            ]);
        }
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

    public function otherprofile($id)
    {
        $userProfile = User::where('id', session('LoggedUser'))->get();
        $other = User::findOrFail($id);
        return view('components.showprofileother', [
            'users' => $userProfile,
            'others'=> $other
        ]);
    }

    public function posteditotherprofile(Request $request)
    {
        // dd($request->all());
        $this->userRepositories->editother($request);
        return back();
    }

    public function editotherprofile($id)
    {
        $userProfile = User::where('id', session('LoggedUser'))->get();
        $other = User::findOrFail($id);
        return view('components.editotherprofile', [
            'users' => $userProfile,
            'others'=> $other
        ]);
    }

    public function addmember(Request $requets)
    {
        // dd($requets->all());
        $this->userRepositories->addmembre($requets);
        return back();
    }

    public function deletemembre(Request $requets)
    {
        $this->userRepositories->deletemembre($requets);
        return back();
    }

    public function modifteamname(Request $requets)
    {
        $this->userRepositories->modifteamname($requets);
        return back()->with('success', 'modification terminer');
    }

    public function modifteamdescription(Request $requets)
    {
        $this->userRepositories->modifteamdescription($requets);
        return back()->with('success', 'modification terminer');
    }

    public function modifteamimage(Request $requets)
    {
        $this->userRepositories->modifteamimage($requets);
        return back()->with('success', 'modification terminer');
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
