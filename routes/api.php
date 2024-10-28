<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// auth
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});

// users
Route::group([
    'middleware' => ['api', 'auth:api'],
    'prefix' => 'user'
], function ($router) {
    Route::get('/{id}', [UserController::class, 'findByUser'])->name('find');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('delete');
});

// users
Route::group([
    'middleware' => ['api', 'auth:api'],
    'prefix' => 'post'
], function ($router) {
    Route::get('/{id}', [PostController::class, 'findByUser'])->name('find');
    Route::post('/create', [PostController::class, 'create'])->name('create');
    Route::put('/post/{id}', [PostController::class, 'update'])->name('update');
});

