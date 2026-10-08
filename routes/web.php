<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/login')->middleware('guest')->group(function(){
    Route::get('/', [PageController::class, 'loginPage'])->name('page.login');
    Route::post('/', [AuthController::class, 'login'])->name('post.login');
});

Route::prefix('/dashboard')->middleware('auth')->group(function(){
    Route::get('/', [PageController::class, 'index'])->name('page.dashboard.index');
    Route::post('/logout',[AuthController::class, 'logout'])->name('post.dashboard.logout');
});
