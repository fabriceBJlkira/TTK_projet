<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginRegisterRepository
{
    public  User $userModel;

    public function __construct()
    {
        $this->userModel = new User;
    }

    // cette fonction est utiliser pour enregistrer un utilisateur et appeler dans Logincontroller
    public function createUsers($users)
    {
        $this->userModel->name =  $users->nom;
        $this->userModel->description =  $users->description;
        $this->userModel->avatar =  $users->avatar;
        $this->userModel->facebook =  $users->facebook;
        $this->userModel->twiter =  $users->twiter;
        $this->userModel->website =  $users->web;
        $this->userModel->discord =  $users->discord;
        $this->userModel->twitch =  $users->twitch;
        $this->userModel->email =  $users->email;
        $this->userModel->password = Hash::make($users->password);
        $this->userModel->save();
    }

    public function loginUser($login)
    {
        return $this->userModel::where('email', $login->email)->first();
    }
}
