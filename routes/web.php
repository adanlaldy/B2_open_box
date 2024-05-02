<?php

use App\Http\Controllers\Auth_controller;
use App\Http\Controllers\mailbox_controller;
use Illuminate\Support\Facades\Route;

//native

//Route::middleware(['App\Http\Middleware\if_disconnected'])->group(function () {
//    Route::get('/registration', [registration_controller::class, 'registration']);
//    Route::post('/registration', [registration_controller::class, 'handling']);
//    Route::get('/login', [login_controller::class, 'form']);
//    Route::post('/login', [login_controller::class, 'handling']);
//});
Route::get('/public', function () {return view('public');});
Route::get('/resources', function () {return view('resources/');});
Route::fallback(function () {return view('error/404');});

//home
Route::get('/home', function () {return view('home');})->name('home');
Route::redirect('/', '/home');

//auth
Route::get('/register', [Auth_controller::class, 'form_register'])->name('auth.register');
Route::post('/register', [Auth_controller::class, 'handling_register']);
Route::delete('/logout', [Auth_controller::class, 'logout'])->name('auth.logout');
Route::get('/login', [Auth_controller::class, 'form_login'])->name('auth.login');
Route::post('/login', [Auth_controller::class, 'handling_login']);

//mailbox
Route::get('/inbox', [mailbox_controller::class, 'inbox'])->name('inbox.index');
Route::post('/inbox', [mailbox_controller::class, 'inbox'])->name('inbox.index');
Route::get('/starred', [mailbox_controller::class, 'starred'])->name('inbox.starred');
Route::get('/sent', [mailbox_controller::class, 'sent'])->name('inbox.sent');
Route::get('/draft', [mailbox_controller::class, 'draft'])->name('inbox.draft');
Route::get('/trash', [mailbox_controller::class, 'trash'])->name('inbox.trash');
Route::get('/spam', [mailbox_controller::class, 'spam'])->name('inbox.spam');
Route::get('/archive', [mailbox_controller::class, 'archive'])->name('inbox.archive');
Route::get('/all_mail', [mailbox_controller::class, 'all'])->name('inbox.all');


//actions
Route::post('/add-to-favorites', [mailbox_controller::class, 'addToFavorites']);
Route::post('/archive-email', [mailbox_controller::class, 'archiveEmail']);
Route::post('/delete-email', [mailbox_controller::class, 'deleteEmail']);

