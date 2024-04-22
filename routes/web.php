<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;

//Route::view('/', 'home');


Route::get('/', function () {
    return view('home');
});

Route::get('/main', function () {
    return view('mail');
});

Route::get('/register', [\App\Http\Controllers\registration_controller::class, 'registration'])->name('auth.register');
Route::post('/register', [\App\Http\Controllers\registration_controller::class, 'doRegister']);

Route::get('/login', [\App\Http\Controllers\login_controller::class, 'login'])->name('auth.login');
Route::post('/login', [\App\Http\Controllers\login_controller::class, 'DoLogin']);


Route::get('/public', function () {
    return view('public');
});

Route::get('/resources', function () {
    return view('resources/');
});

//Route::middleware(['App\Http\Middleware\if_disconnected'])->group(function () {
//    Route::get('/registration', [registration_controller::class, 'registration']);
//    Route::post('/registration', [registration_controller::class, 'handling']);
//    Route::get('/login', [login_controller::class, 'form']);
//    Route::post('/login', [login_controller::class, 'handling']);
//});

Route::middleware(['App\Http\Middleware\if_connected'])->group(function () {
});
