<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/login')->group(function(){
    Route::get('/')->name('page.login');
    Route::post('/')->name('post.login');
});

Route::prefix('/dashboard')->group(function(){
    Route::post('/logout')->name('post.dashboard.logout');
});
