<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\AlreadyAuthenticated;
use Illuminate\Support\Facades\Route;

Route::middleware(AlreadyAuthenticated::class)->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('/login', function () {
        return view('authentication.login');
    })->name("login");
    Route::get('/register', function () {
        return view('authentication.register');
    })->name("register");
});

Route::middleware(['auth'])->group(function () {
    Route::controller(MainController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });

    Route::controller(PostController::class)->name('post.')->group(function () {
        Route::post('/addPost', 'addPost')->name('add');
        Route::put('/editPost', 'editPost')->name('edit');
        Route::delete('/deletePost/{id}', 'deletePost')->name('delete');

        Route::patch('/starPost/{id}', 'starPost')->name('star');
    });
});

Route::controller(AuthenticationController::class)->group(function () {
    Route::post('/register', 'register')->name('register.user');
    Route::post('/login', 'login')->name('login.user');
    Route::get('/logout', 'logout')->name('logout');
});
