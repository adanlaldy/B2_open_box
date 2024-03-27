<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;

//Route::view('/', 'home');


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['App\Http\Middleware\if_disconnected'])->group(function () {
    Route::get('/registration', [registration_controller::class, 'form']);
    Route::post('/registration', [registration_controller::class, 'handling']);
    Route::get('/login', [login_controller::class, 'form']);
    Route::post('/login', [login_controller::class, 'handling']);
});

Route::middleware(['App\Http\Middleware\if_connected'])->group(function () {
});
