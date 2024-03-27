<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;

//Route::view('/', 'home');


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['App\Http\Middleware\IfDisconnected'])->group(function () {
    Route::get('/registration', [RegistrationController::class, 'form']);
    Route::post('/registration', [RegistrationController::class, 'handling']);
    Route::get('/login', [LoginController::class, 'form']);
    Route::post('/login', [LoginController::class, 'handling']);
});

Route::middleware(['App\Http\Middleware\IfConnected'])->group(function () {
});
