<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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
        $userProfile = User::where('id', session('LoggedUser'))->get();
        return view(config('app.joueur'),[
            'users' => $userProfile
        ]);
    }

    public function profil()
    {
        $userProfile = User::where('id', session('LoggedUser'))->get();
        $modification = $userProfile;
        // dd($userProfile);
        return view('Auth.navbar', [
            'users'=>$userProfile,
            'modification' => $modification
        ]);
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
