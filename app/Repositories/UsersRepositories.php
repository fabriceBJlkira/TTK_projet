<?php

namespace App\Repositories;

use App\Models\Team;
use App\Models\TeamUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersRepositories
{
    private  User $userModels;
    private Team $teamModels;
    private TeamUser $teamMembreModels;

    public function __construct()
    {
        $this->userModels = new User;
        $this->teamModels = new Team;
        $this->teamMembreModels = new TeamUser;
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
            'statut' => 'actif'
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
}
