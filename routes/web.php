<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;
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

Route::get('/home/{user}', function ($user) {
    return "ini hamana home {$user}";
});
Route::get('/home', function () {
    return view('home',[
        "title" => 'Halaman Home',
        "active" => 'Home'
    ]);
});

Route::get('/login', [LoginController::class, 'index']) -> name ('login') -> middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/dashboard', [DashboardController::class, 'index']) -> middleware('auth');
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']) ;

Route::resource('post-category', PostCategoryController::class)->middleware('auth');
Route::resource('post', PostController::class)->middleware('auth');
