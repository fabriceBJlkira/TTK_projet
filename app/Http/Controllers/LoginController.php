<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRegisterRequest;
use App\Repositories\LoginRegisterRepository;

class LoginController extends Controller
{
    // ce LoginController permet aux utilisateurs de s'authentifier

    private $loginRegisterRepository;

    public function __construct()
    {
        $this->loginRegisterRepository = new LoginRegisterRepository();
    }

    public function index()
    {
        return view(config('app.login'));
    }
    public function register()
    {
        return view(config('app.register'));
    }

    public function createUsers(LoginRegisterRequest $request)
    {
        $request->validated();

        $this->loginRegisterRepository->createUsers($request);

        return back()->with('sucses', 'enregistrement terminer, login');
    }

    public function login(Request $request)
    {
        // dd($request->path());
        $request->validate([
            'email' => ['required', 'email'],
            'psw' => ['required', 'min:8']
        ]);

        $userInfo = $this->loginRegisterRepository->loginUser($request);

        if (!$userInfo) {
            return back()->with('fail', 'L\'email n\'existe pas');
        } else {
            if (Hash::check($request->psw, $userInfo->password)) {
                $request->session()->put('LoggedUser', $userInfo->id);
                return redirect(config(('app.home')));
            } else{
                return back()->with('fail', 'Email ou mot de passe incorect');
            }
        }
    }
}
