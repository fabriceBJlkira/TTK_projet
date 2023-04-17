<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

    // team et create team et modif team
    Route::get('/team/{id}', [HomeController::class, 'teams'])->name(('team'));
    Route::get('/Create/team', [HomeController::class, 'teamsCreate'])->name(('teamCreate'));
    Route::post('team/create/post', [HomeController::class, 'teamCreatePost'])->name('teamCreatePost');
});
