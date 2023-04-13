<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersRepositories
{
    private  User $userModels;

    public function __construct()
    {
        $this->userModels = new User;
    }

    public function modifusers($users)
    {
        // dd($users->all());
        $profil= $this->userModels::where('id', session('LoggedUser'));
        $verif = $profil->get();

        if ($users->imgp!==null) {
            // dd($users->file('imgp'));
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
}
