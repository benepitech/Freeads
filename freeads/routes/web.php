<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdController;
//use App\Http\Controllers\FrontController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Post_adController;
use App\Http\Controllers\ProductController;

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

//Route::middleware(['admin'])->group(function () {
//    Route::resource('/users', UserController::class);
//    Route::resource('/ads', AdController::class);
//});


Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::resource('/users', UserController::class);
    Route::resource('/ads', AdController::class);
    Route::resource('/categories', CategoryController::class);

  

});

Route::get('access_my_ads', [AdController::class, 'user_ads'])->name('access_my_ads');
Route::get('/show_my_ads/{id}', [AdController::class, 'user_show_ads'])->name('show_my_ads');


Route::get('user_show_ad/{id}', [AdController::class, 'see_ad_detail'])->name('user_show_ad');



Route::post('/create-ads', [AdController::class, 'create_by_user'])->name('create_by_user');
Route::get('/post_ad',[AdController::class, 'form_create_ad'])->name('form_create_ad');

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('register', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('home', [AuthController::class, 'home'])->name('home');




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
