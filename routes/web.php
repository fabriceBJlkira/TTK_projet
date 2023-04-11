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

    Route::get('/profil', [HomeController::class, 'navbar']);
});
