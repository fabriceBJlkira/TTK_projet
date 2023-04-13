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
        $this->userModel->email =  $users->email;
        $this->userModel->password = Hash::make($users->password);
        $this->userModel->save();
    }

    public function loginUser($login)
    {
        return $this->userModel::where('email', $login->email)->first();
    }
}
