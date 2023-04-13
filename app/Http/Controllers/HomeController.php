<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilModifRequest;
use App\Models\User;
use App\Repositories\UsersRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            // dd($userProfile);
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

    // logout
    public function logout()
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('');
        }
    }
}
