<?php

use App\Http\Controllers\HomeController;
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



Route::controller(LoginController::class)->group(function (){
    Route::get('/login','create')->middleware('guest');
    Route::post('/login','loginUser')->middleware('guest');

    Route::get('/logout','logOutUser')->middleware('auth');
});

Route::get('/home', [HomeController::class,'index']);


Route::prefix('register')->group(function () {
    Route::get('',[RegisterController::class,'create'])->middleware('guest');
    Route::post('', [RegisterController::class, 'store'])->middleware('guest');
});


Route::prefix('posts')->group(function (){
    Route::get('/create',[PostController::class,'create'])->name('posts.create');
    Route::post('/store',[PostController::class, 'store'])->name('posts.store');

    Route::get('/{slug}',[PostController::class,'show'])->name('posts.show');
});
