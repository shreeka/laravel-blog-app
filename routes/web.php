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
    return redirect('/home');
});



Route::controller(LoginController::class)->group(function (){
    Route::get('/login','create');
    Route::post('/login','loginUser');

    Route::get('/logout','logOutUser');
});

Route::get('/home', [HomeController::class,'index']);


Route::prefix('register')->group(function () {
    Route::get('',[RegisterController::class,'create']);
    Route::post('', [RegisterController::class, 'store']);
});


Route::prefix('posts')->group(function (){
    Route::get('/create',[PostController::class,'create'])->name('posts.create');
    Route::post('/store',[PostController::class, 'store'])->name('posts.store');
    Route::get('/{post:slug}',[PostController::class,'show'])->name('posts.show');
    Route::get('/{post:slug}/edit',[PostController::class,'edit'])->name('posts.edit');
    Route::post('/update',[PostController::class, 'update'])->name('posts.update');
    Route::post('/destroy/{post}',[PostController::class, 'destroy'])->name('posts.destroy');
});
