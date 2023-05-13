<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Hashids\Hashids;
use App\Models\Annonce;
use App\Models\Games;
use App\Models\TeamUser;
use App\Models\UserGame;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UsersRepositories;

class MessageController extends Controller
{
    //
    private $userRepositories;
    private $hash;

    public function __construct()
    {
        $this->userRepositories = new UsersRepositories();
        $this->hash = new Hashids();
    }

    public function show(Request $request, $id)
    {
        $hash = $this->hash;
        $request->validate([
            'content' => 'required'
        ]);
        $this->userRepositories->message($request, $hash->decodeHex($id));

        return back();
    }

    public function annonce(Request $request, Team $team, $id)
    {
        $hash = $this->hash;
        $request->validate([
            'contenue' => 'required'
        ]);

        $team_id = $team::findOrFail($hash->decodeHex($id));

        $this->userRepositories->annonce($request, $team_id->id);

        return back();
    }

    public function annoncedelete($id)
    {
        $hash = $this->hash;
        $annomce_id = Annonce::findOrFail($hash->decodeHex($id));

        $this->userRepositories->deleteannomce($annomce_id->id);
        return back();
    }

    public function annonceup($id, Request $request)
    {
        $hash = $this->hash;
        $annomce_id = Annonce::findOrFail($hash->decodeHex($id));

        $this->userRepositories->updateannonce($annomce_id->id, $request);
        return back();
    }

    public function annoncesearch($id, Request $request)
    {
        $user = User::where('id', session('LoggedUser'))->first();
        $hash = new Hashids();
        $team_id = Team::findOrFail($hash->decodeHex($id));
        $annonces = null;
        $annonceadmin = null;
        $pivot = TeamUser::where('team_id', $team_id->id)->where('user_id', session('LoggedUser'))->first();
        // dd($users);
        if (isset($request->annonceadmin)) {
            $annonceadmin = DB::select('SELECT annonces.id, annonces.contenue, annonces.team_id, annonces.user_id, users.name, users.avatar, teams.id AS team_id FROM annonces INNER JOIN teams ON (annonces.team_id = teams.id) INNER JOIN users ON (annonces.user_id = users.id)WHERE annonces.team_id = '. $team_id->id.' AND LOWER(users.name) LIKE "%'.Str::lower($_GET['annonceadmin']).'%" OR LOWER(annonces.contenue) LIKE "%'.Str::lower($_GET['annonceadmin']).'%" ORDER BY annonces.id desc');
        } else {
            $annonces = DB::select('SELECT annonces.id, annonces.contenue, annonces.team_id, annonces.user_id, users.name, users.avatar, teams.id AS team_id FROM annonces INNER JOIN teams ON (annonces.team_id = teams.id) INNER JOIN users ON (annonces.user_id = users.id)WHERE annonces.team_id = '. $team_id->id.' AND LOWER(users.name) LIKE "%'.Str::lower($_GET['annonce']).'%" OR LOWER(annonces.contenue) LIKE "%'.Str::lower($_GET['annonce']).'%" ORDER BY annonces.id desc');
        }

        return view('components.Annonce.rechercheannonce', [
            'hash' => $hash,
            'annonces' => $annonces,
            'annonceadmins' => $annonceadmin,
            'team_id' => $team_id->id,
            'user' =>$user,
            'pivots' => $pivot
        ]);
    }

    public function newmember($id)
    {
        $hash = $this->hash;
        $ids = DB::select('SELECT distinct user_id FROM team_user WHERE team_id = '.$hash->decodeHex($id));
        $team_id = $hash->decodeHex($id);

        $admin = User::where('id', session('LoggedUser'))->first();
        $array = [];
        for ($i=0; $i < count($ids); $i++) {
            $array [] = $ids[$i]->user_id;
        }
        if (isset($_GET['searchequipe'])) {
            $alluser = DB::table('users')
                    ->where(Str::lower('name'), 'LIKE', '%'. Str::lower($_GET['searchequipe']).'%')
                        ->whereNotIn('users.id', $array)
                        ->paginate(12);
        } else {
            $alluser = DB::table('users')
                        ->whereNotIn('users.id', $array)
                        ->paginate(12);
        }


        return view('components.addmember', [
            'allusers' => $alluser,
            'hash' => $hash,
            'admin' => $admin,
            'team_id' => $team_id
        ]);
    }

    public function newmemberadd($id, $id2)
    {
        $hash = $this->hash;
        $this->userRepositories->addnewmember($hash->decodeHex($id), $hash->decodeHex($id2));

        return back();
    }

    public function game()
    {
        $hash = $this->hash;
        $query = User::where('id', session('LoggedUser'));
        $admin = $query->first();
        $user = $query->get();

        if (isset($_GET['searchgame'])) {
            $Game = DB::table('games')
                    ->where('name', 'LIKE', '%'.$_GET['searchgame'].'%')
                    ->orWhere('specifique', 'LIKE', '%'.$_GET['searchgame'].'%')
                    ->paginate(12);
        } else {
            $Game = Games::paginate(12);
        }

        // dd($arrayGameId);
        return view('game', [
            'games' => $Game,
            'users' => $user,
            'admin'=> $admin,
            'hash'=> $hash,
        ]);
    }

    public function gamepost($id, $id1, $id2)
    {
        $hash = $this->hash;
        // verification si le jeux est deja dns le groupe
        $ifChoosed = UserGame::where('team_id', $hash->decodeHex($id2))->get();
        $arrayGameId =[];
        foreach ($ifChoosed as $value) {
            $arrayGameId [] = $value->game_id;
        }

        if (in_array($hash->decodeHex($id1), $arrayGameId)) {
            return back()->with('eror', 'ce jeux existe déjà dans ce groupe');
        }
        $this->userRepositories->postitemgame($hash->decodeHex($id), $hash->decodeHex($id1), $hash->decodeHex($id2));

        return back();
    }

    public function gamepostitem()
    {
        return view('components.game.post');
    }

    public function postgame(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:games,name',
            'baner' => 'required'
        ]);
        // dd( $request->spesifique);
        $this->userRepositories->postgamefromdatabase($request);

        return redirect('game');
    }
}
