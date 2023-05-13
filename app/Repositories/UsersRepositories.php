<?php

namespace App\Repositories;

use App\Models\Annonce;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\User;
use App\Models\Games;
use App\Models\Message;
use App\Models\TeamUser;
use App\Models\UserGame;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersRepositories
{
    private  User $userModels;
    private Team $teamModels;
    private TeamUser $teamMembreModels;
    private Games $gameModels;
    private UserGame $usergameModels;
    private Message $messageModels;
    private Annonce $annonceModels;

    public function __construct()
    {
        $this->userModels = new User;
        $this->teamModels = new Team;
        $this->teamMembreModels = new TeamUser;
        $this->gameModels = new Games;
        $this->usergameModels = new UserGame;
        $this->messageModels = new Message;
        $this->annonceModels = new Annonce;
    }

    public function modifusers($users)
    {

        $profil= $this->userModels::where('id', session('LoggedUser'));
        $verif = $profil->get();

        if ($users->imgp!==null) {

            $filename =  time() . '.' . $users->imgp->extension();

            $users->file('imgp')->storeAs(
                'photoProfile',
                $filename,
                'public'
            );
        } else {
            $filename = $verif[0]->avatar;
        }

        if ($users->mdp === null AND $users->email === null) {
            $profil->update([
                'name' =>$users->nom,
                'description' =>$users->des,
                'avatar' =>$filename,
                'facebook' =>$users->facebook,
                'twiter' =>$users->twiter,
                'website' =>$users->web,
                'discord' =>$users->discord,
                'twitch' =>$users->twitch,
            ]);
        } else {
            if (Hash::check($users->mdp, $verif[0]->password)) {
                $profil->update([
                    'name' =>$users->nom,
                    'description' =>$users->des,
                    'avatar' =>$filename,
                    'facebook' =>$users->facebook,
                    'twiter' =>$users->twiter,
                    'website' =>$users->web,
                    'discord' =>$users->discord,
                    'twitch' =>$users->twitch,
                    'email' =>$users->email,
                    'password' =>Hash::make($users->password)
                ]);
            } else{
                return back()->with('fail', 'Email ou mot de passe incorect');
            }
        }
    }

    // creation de l'equipe
    public function createEquipe($equipe)
    {
        $profil= $this->userModels::where('id', session('LoggedUser'));
        $createurs = $profil->get();
        $createur = $createurs[0]->id;

        $filename =  time() . '.' . $equipe->logoteam->extension();

        $equipe->file('logoteam')->storeAs(
            'LogoTeam',
            $filename,
            'public'
        );

        $profil->update([
            'type' => 'admin'
        ]);

        $this->teamModels::create([
            'name' => $equipe->nom,
            'logo' => $filename,
            'user_id' => $createur,
            'description' => $equipe->des
        ]);
        $admin =$this->teamModels::where('user_id', $createur)
        ->orderby('id', 'desc')->first();
        // dd($admin->id);

        $this->teamMembreModels::create([
            'user_id'=> $createurs[0]->id,
            'team_id'=> $admin->id,
            'statut' => 'admin'
        ]);
    }
    public function adesion($users)
    {
        $userId = $this->userModels::where('id', session('LoggedUser'))->first();

        $this->teamMembreModels::create([
            'user_id'=> $userId->id,
            'team_id' => $users->id
        ]);
    }

    public function addmembre($id, $id1)
    {
        $add = $this->teamMembreModels::where('user_id', $id)->where('team_id', $id1);

        $add->update([
            'statut' =>'membre'
        ]);
    }

    public function deletemembre($id, $id1)
    {
        DB::select('DELETE FROM team_user WHERE user_id = '.$id.' AND team_id = '.$id1);
    }

    public function coadmin($id, $id1)
    {
        $add = $this->teamMembreModels::where('user_id', $id)->where('team_id', $id1);

        $add->update([
            'statut' =>'co-admin'
        ]);
    }

    public function editother($users)
    {

        $profil= $this->userModels::where('id', $users->id);
        $verif = $profil->get();

        if ($users->imgp!==null) {

            $filename =  time() . '.' . $users->imgp->extension();

            $users->file('imgp')->storeAs(
                'photoProfile',
                $filename,
                'public'
            );
        } else {
            $filename = $verif[0]->avatar;
        }

        if ($users->password === null AND $users->email === null) {
            $profil->update([
                'name' =>$users->nom,
                'description' =>$users->des,
                'avatar' =>$filename,
                'facebook' =>$users->facebook,
                'twiter' =>$users->twiter,
                'website' =>$users->web,
                'discord' =>$users->discord,
                'twitch' =>$users->twitch,
            ]);
        } else {
            $profil->update([
                'name' =>$users->nom,
                'description' =>$users->des,
                'avatar' =>$filename,
                'facebook' =>$users->facebook,
                'twiter' =>$users->twiter,
                'website' =>$users->web,
                'discord' =>$users->discord,
                'twitch' =>$users->twitch,
                'email' =>$users->email,
                'password' =>Hash::make($users->password)
            ]);
        }
    }

    public function modifteamname($user)
    {
        $team = $this->teamModels::where('id', $user->id);

        $team->update([
            'name' => $user->name
        ]);
    }

    public function modifteamdescription($user)
    {
        $team = $this->teamModels::where('id', $user->id);

        $team->update([
            'description' => $user->description
        ]);
    }

    public function modifteamimage($user)
    {
        $team = $this->teamModels::where('id', $user->id);

        if ($user->logoteam!==null) {

            $filename =  time() . '.' . $user->logoteam->extension();

            $user->file('logoteam')->storeAs(
                'LogoTeam',
                $filename,
                'public'
            );

            $team->update([
                'logo' => $filename
            ]);
        }
    }

    public function leavegroup($user)
    {
        DB::delete('DELETE FROM team_user WHERE user_id = '.$user->id);
    }

    public function postgame($user, $id)
    {
        for ($i=0; $i < count($user->team); $i++) {
            for ($j=0; $j < count($user->jeux); $j++) {
                $this->usergameModels::create([
                    'user_id' => $id,
                    'game_id' => $user->jeux[$j],
                    'team_id' => $user->team[$i]
                ]);
            }
        }
    }

    public function postitemgame($id, $id1, $id2)
    {
        $this->usergameModels::create([
            'user_id' => $id,
            'game_id' => $id1,
            'team_id' => $id2
        ]);
    }

    public function message($user, $id)
    {
        $expeditaire = $this->userModels::where('id', session('LoggedUser'))->first();

        $this->messageModels::create([
            'from_id' => $expeditaire->id,
            'to_id' => $id,
            'contenue' => $user->content
        ]);
    }

    public function unreadmessage()
    {
        return DB::select('SELECT COUNT(id) AS count FROM messages WHERE from_id != '.session('LoggedUser').' AND to_id = '.session('LoggedUser') .' AND read_at is null');
    }

    public function readAllFrom($query)
    {
        $query->update([
            'read_at' => Carbon::now()
        ]);
    }

    public function deletegamefromgroupe($id, $id2)
    {
        return DB::delete('DELETE FROM user_game WHERE team_id = '.$id. ' AND game_id = '.$id2);
    }

    public function postgamefromdatabase($user)
    {
        $filename1 =  time() . '.' . $user->baner->extension();

        $user->file('baner')->storeAs(
            'gameimage/banner',
            $filename1,
            'public'
        );
        $filename2 = null;
        if ($user->icone !== null) {
            $filename2 =  time() . '.' . $user->icone->extension();

            $user->file('icone')->storeAs(
                'gameimage/icon',
                $filename2,
                'public'
            );
        }
        // dd($user->spesifique);
        $this->gameModels::create([
            'name' => $user->name,
            'banner' => $filename1,
            'specifique' => $user->spesifique,
            'icone' =>  $filename2
        ]);
    }

    public function annonce($users, $team_id)
    {
        $postepar = $this->userModels::where('id', session('LoggedUser'))->first();
        $this->annonceModels::create([
            'contenue' => $users->contenue,
            'team_id' => $team_id,
            'user_id' => $postepar->id,
        ]);
    }

    public function deleteannomce($annonce_id)
    {
        return DB::delete('DELETE FROM annonces WHERE id ='.$annonce_id);
    }

    public function updateannonce($annonce_id, $users)
    {
        $annonce = $this->annonceModels::where('id', $annonce_id);

        $annonce->update([
            'contenue' => $users->contenue
        ]);
    }

    public function addnewmember($id, $id2)
    {
        $user = $this->userModels::findOrFail($id);
        $user_id = $user->id;
        $team = $this->teamModels::findOrFail($id2);
        $team_id = $team->id;

        $this->teamMembreModels::create([
            'user_id' => $user_id,
            'team_id' => $team_id,
            'statut' => 'membre'
        ]);
    }
}
