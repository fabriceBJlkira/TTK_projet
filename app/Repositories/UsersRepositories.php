<?php

namespace App\Repositories;

use App\Models\Games;
use App\Models\Team;
use App\Models\User;
use App\Models\TeamUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersRepositories
{
    private  User $userModels;
    private Team $teamModels;
    private TeamUser $teamMembreModels;
    private Games $gameModels;

    public function __construct()
    {
        $this->userModels = new User;
        $this->teamModels = new Team;
        $this->teamMembreModels = new TeamUser;
        $this->gameModels = new Games;
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
            'statut' => 'membre'
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

    public function addmembre($user)
    {
        $add = $this->teamMembreModels::where('user_id', $user->id)->where('team_id', $user->groupid);

        $add->update([
            'statut' =>'membre'
        ]);
    }

    public function deletemembre($user)
    {
        DB::select('DELETE FROM team_user WHERE user_id = '.$user->id.' AND team_id = '.$user->groupid);
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

    public function gameadd($user)
    {

    }
}
