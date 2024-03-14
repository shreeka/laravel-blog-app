<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('welcome');

Route::get('/login', [LoginController::class, 'create'])->middleware('guest');
Route::post('/login', [LoginController::class,'loginUser'])->middleware('guest');

Route::get('/logout', [LoginController::class, 'logOutUser'])->middleware('auth');

Route::get('/home',function (){
   return view('home');
})->middleware('auth');

Route::get('/register',[RegisterController::class,'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/new-post',[PostController::class,'create']);
Route::post('/new-post',[PostController::class, 'store']);

Route::get('/show-post',[PostController::class,'show']);
