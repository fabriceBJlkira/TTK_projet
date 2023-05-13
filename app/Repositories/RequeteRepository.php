<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\User;
use App\Models\Games;
use App\Models\Annonce;
use App\Models\Message;
use App\Models\TeamUser;
use App\Models\UserGame;
use Hashids\Hashids;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RequeteRepository
{
    private  User $userModels;
    private Team $teamModels;
    private TeamUser $teamMembreModels;
    private Games $gameModels;
    private UserGame $usergameModels;
    private Message $messageModels;
    private Annonce $annonceModels;
    private Hashids $hash;

    public function __construct()
    {
        $this->userModels = new User;
        $this->teamModels = new Team;
        $this->teamMembreModels = new TeamUser;
        $this->gameModels = new Games;
        $this->usergameModels = new UserGame;
        $this->messageModels = new Message;
        $this->annonceModels = new Annonce;
        $this->hash = new Hashids;
    }

    public function getUser()
    {
        return $this->userModels::where('id', session('LoggedUser'))->get();
    }

    public function firstUser()
    {
        return $this->userModels::where('id', session('LoggedUser'))->first();
    }

    public function annonceHome(Array $id)
    {
        return DB::table('annonces')->join('teams', 'annonces.team_id', '=', 'teams.id')
        ->join('users', 'annonces.user_id', '=', 'users.id')
        ->select('annonces.id', 'annonces.contenue', 'annonces.team_id', 'annonces.user_id', 'users.name', 'users.avatar', 'teams.id as team_id', 'teams.name as teamename')
        ->whereIn('annonces.team_id', $id)
        ->orderBy('annonces.id', 'desc')
        ->paginate(10);
    }

    public function getAllGame()
    {
        return $this->gameModels::all();
    }

    public function getAllUserTeam()
    {
        return $this->teamModels::where('user_id', session('LoggedUser'))->get();
    }

    public function findOrFailTeam($id)
    {
        return $this->teamModels::findOrFail($id);
    }

    public function getPivot($group_id)
    {
        return $this->teamMembreModels::where('team_id', $group_id)->where('user_id', session('LoggedUser'))->first();
    }

    public function getAllMembre($groupe_id, int $user_id)
    {
        return DB::table('team_user')->join('users', 'team_user.user_id', '=', 'users.id')
        ->select('team_user.*', 'users.*')
        ->where('team_id', $groupe_id)
        ->where('id','!=', $user_id)
        ->where('statut', '!=', 'en attente')
        ->paginate(8);

    }
    public function getAllMembreMessage($groupe_id, int $user_id)
    {
        return DB::table('team_user')->join('users', 'team_user.user_id', '=', 'users.id')
        ->select('team_user.*', 'users.*')
        ->where('team_id', $groupe_id)
        ->where('id','!=', $user_id)
        ->where('statut', '!=', 'en attente')
        ->get();
    }

    public function getAllMembreEnattente($groupe_id, int $user_id)
    {
        return DB::table('team_user')->join('users', 'team_user.user_id', '=', 'users.id')
        ->select('team_user.*', 'users.*')
        ->where('team_id', $groupe_id)
        ->where('id','!=', $user_id)
        ->where('statut', 'en attente')
        ->get();
    }

    public function getGame($groupe_id)
    {
        return DB::table('user_game')->join('teams', 'user_game.team_id', '=', 'teams.id')
        ->join('games', 'user_game.game_id', '=', 'games.id')
        ->select('games.id as gameid', 'user_game.team_id as teamid', 'user_game.game_id as gameid', 'games.name as gamename', 'games.banner', 'games.icone', 'games.specifique', 'teams.id as idteam', 'teams.name as teamename', 'teams.logo', 'teams.user_id as createur', 'teams.description')
        ->where('team_id', $groupe_id)
        ->paginate(8);
    }

    public function message()
    {
        return $this->messageModels::where('from_id', session('LoggedUser'))
        ->where('to_id', $this->hash->decodeHex($_GET['to']))
        ->orwhere('from_id', $this->hash->decodeHex($_GET['to']))
        ->where('to_id', session('LoggedUser'))
        ->orderby('created_at', 'desc');
    }

    public function annonceTeam($groupe_id)
    {
        return DB::table('annonces')->join('teams', 'annonces.team_id', '=', 'teams.id')
        ->join('users', 'annonces.user_id', '=', 'users.id')
        ->select('annonces.id', 'annonces.contenue', 'annonces.team_id', 'annonces.user_id', 'users.name', 'users.avatar', 'teams.id as team_id')
        ->where('annonces.team_id', $groupe_id)
        ->orderBy('annonces.id', 'desc')
        ->paginate(8);
    }

    public function getTeamPaginate($page)
    {
        return $this->teamModels::paginate($page);
    }

    public function searchTeam($user)
    {
        return $this->teamModels::where('name','LIKE', '%'.$user->groupe.'%')->get();
    }

    public function getPivotSearchTeam()
    {
        return $this->teamMembreModels::where('user_id', session('LoggedUser'))->get();
    }

    public function getjoueur($page)
    {
        return $this->userModels::where('id', '!=', session('LoggedUser'))->paginate($page);
    }

    public function getjoueurSearch($getjoueur, $page)
    {
        return $this->userModels::where('id', '!=', session('LoggedUser'))
        ->where('name', 'LIKE', '%'.$getjoueur.'%')
        ->paginate($page);
    }

    public function getjoueurSearchFiltre($getnomjoueur, $filtreequipe, $filtrejeux, )
    {
        $requete = 'SELECT users.id, users.name, users.avatar, teams.id AS teamid, teams.name AS teamename  FROM users INNER JOIN teams ON (users.id = teams.id)  WHERE users.id != '.session('LoggedUser');

        if ($filtreequipe !== '') {
            $requete.= ' AND users.id IN (SELECT user_id FROM team_user WHERE team_id = '.$filtreequipe.' AND statut != "en attente")';
        }

        if ($filtrejeux !== '') {
            $requete.= ' AND users.id IN (SELECT team_user.user_id FROM team_user INNER JOIN user_game ON (team_user.team_id= user_game.team_id)  WHERE user_game.game_id = '.$filtrejeux.' AND team_user.statut != "en attente")';
        }

        if ($getnomjoueur !== '') {
            $requete.= ' AND users.name LIKE "%'.$getnomjoueur.'%"';
        }
        return DB::select($requete);
    }

    public function getEquipe()
    {
        return $this->teamModels::all();
    }

    public function getGameEquipe()
    {
        return $this->gameModels::all();
    }

}
