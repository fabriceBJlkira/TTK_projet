<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/register/post', [LoginController::class, 'createUsers'])->name('register.create');
Route::post('/login', [LoginController::class, 'login'])->name('login.log');

Route::group(['middleware'=>['UserLoad']], function(){

    // route authentification
    Route::get('', [LoginController::class, 'index'])->name('login');
    Route::get('/register', [LoginController::class, 'register'])->name('register');

    // route home
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/joueur', [HomeController::class, 'joueur'])->name('joueur');

    // profile et modif
    Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
    Route::get('/profil/modification', [HomeController::class, 'modificationProfile'])->name('modificationProfile');
    Route::post('/profil/modification/post', [HomeController::class, 'modificationProfilePost'])->name('modificationProfilepost');
    Route::post('/profil/modificationgame/post', [HomeController::class, 'modificationgameProfilepost'])->name('modificationgameProfilepost');
    Route::get('/find/profile/{id}', [HomeController::class, 'otherprofile'])->name(('other'));
    Route::get('/find/profile/edit/{id}', [HomeController::class, 'editotherprofile'])->name(('editother'));
    Route::post('/other/edit/post', [HomeController::class, 'posteditotherprofile'])->name(('posteditother'));

    // team et create team et modif team
    Route::get('/team/{id}', [HomeController::class, 'teams'])->name(('team'));
    Route::get('/Create/team', [HomeController::class, 'teamsCreate'])->name(('teamCreate'));
    Route::post('/create/team/post', [HomeController::class, 'teamCreatePost'])->name('teamCreatePost');
    Route::get('/find/team', [HomeController::class, 'rechercheTeam'])->name(('rechercheTeam'));
    Route::post('/find/team/adesion', [HomeController::class, 'adesion'])->name('adesion');
    Route::post('/modif/team/name', [HomeController::class, 'modifteamname'])->name('modifteamname');
    Route::post('/modif/team/description', [HomeController::class, 'modifteamdescription'])->name('modifteamdescription');
    Route::post('/modif/team/image', [HomeController::class, 'modifteamimage'])->name('modifteamimage');

    // demande d'adhesion dans le groupe
    Route::post('/add/member', [HomeController::class, 'addmember'])->name('addmember');
    Route::post('/delete/member', [HomeController::class, 'deletemembre'])->name('deletemembre');
});
