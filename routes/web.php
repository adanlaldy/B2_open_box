<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use Laravel\Folio\Folio;

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

Route::get('/inbox', [\App\Http\Controllers\mailbox_controller::class, 'inbox']);

Route::middleware(['App\Http\Middleware\if_connected'])->group(function () {
});