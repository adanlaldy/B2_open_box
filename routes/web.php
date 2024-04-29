<?php

use App\Http\Controllers\Auth_controller;
use App\Http\Controllers\main_controller;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {return view('home');})->name('home');
Route::redirect('/', '/home');
Route::get('/main', [main_controller::class, 'main'])->name('main');

// Authentification
Route::get('/register', [Auth_controller::class, 'registration'])->name('auth.register');
Route::post('/register', [Auth_controller::class, 'doRegister']);
Route::delete('/logout', [Auth_controller::class, 'logout'])->name('auth.logout');

Route::get('/login', [Auth_controller::class, 'login'])->name('auth.login');
Route::post('/login', [Auth_controller::class, 'DoLogin']);

Route::get('/public', function () {
    return view('public');
});

Route::get('/resources', function () {
    return view('resources/');
});

Route::fallback(function () {
    return view('404');
});

//Route::middleware(['App\Http\Middleware\if_disconnected'])->group(function () {
//    Route::get('/registration', [registration_controller::class, 'registration']);
//    Route::post('/registration', [registration_controller::class, 'handling']);
//    Route::get('/login', [login_controller::class, 'form']);
//    Route::post('/login', [login_controller::class, 'handling']);
//});
Route::get('/inbox', [\App\Http\Controllers\mailbox_controller::class, 'inbox'])->name('inbox.index');
Route::get('/starred', [\App\Http\Controllers\mailbox_controller::class, 'starred'])->name('inbox.starred');
Route::get('/sent', [\App\Http\Controllers\mailbox_controller::class, 'sent'])->name('inbox.sent');
Route::get('/draft', [\App\Http\Controllers\mailbox_controller::class, 'draft'])->name('inbox.draft');
Route::get('/trash', [\App\Http\Controllers\mailbox_controller::class, 'trash'])->name('inbox.trash');
Route::get('/spam', [\App\Http\Controllers\mailbox_controller::class, 'spam'])->name('inbox.spam');
Route::get('/archive', [\App\Http\Controllers\mailbox_controller::class, 'archive'])->name('inbox.archive');


Route::middleware(['App\Http\Middleware\if_connected'])->group(function () {
});
