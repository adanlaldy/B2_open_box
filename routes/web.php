<?php

use App\Http\Controllers\auth_controller;
use App\Http\Controllers\Language;
use App\Http\Controllers\mailbox_controller;
use Illuminate\Support\Facades\Route;

$lang = 'en'; // Par exemple, anglais par défaut
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
//    $language = new Language();
}


//native

Route::middleware(['App\Http\Middleware\if_disconnected'])->group(function () {
    //auth
    Route::get('/register', [auth_controller::class, 'form_register'])->name('auth.register');
    Route::post('/register', [auth_controller::class, 'handling_register']);
    Route::get('/login', [auth_controller::class, 'form_login'])->name('auth.login');
    Route::post('/login', [auth_controller::class, 'handling_login']);
});

Route::middleware(['App\Http\Middleware\if_connected'])->group(function () {
    //logout
    Route::delete('/logout', [auth_controller::class, 'logout'])->name('auth.logout');
    //mailbox
    Route::get('/inbox', [mailbox_controller::class, 'form_inbox'])->name('inbox.index');
    Route::post('/inbox', [mailbox_controller::class, 'handling_inbox'])->name('inbox.index');
    Route::get('/starred', [mailbox_controller::class, 'form_starred'])->name('inbox.starred');
    Route::get('/sent', [mailbox_controller::class, 'form_sent'])->name('inbox.sent');
    Route::get('/draft', [mailbox_controller::class, 'form_draft'])->name('inbox.draft');
    Route::get('/trash', [mailbox_controller::class, 'form_trash'])->name('inbox.trash');
    Route::get('/spam', [mailbox_controller::class, 'form_spam'])->name('inbox.spam');
    Route::get('/archive', [mailbox_controller::class, 'form_archive'])->name('inbox.archive');
    Route::get('/all_mail', [mailbox_controller::class, 'form_all'])->name('inbox.all');
    Route::get('/parameters', [mailbox_controller::class, 'parameters'])->name('inbox.parameters');
    //actions
    Route::post('/add-to-starred', [mailbox_controller::class, 'add_to_starred']);
    Route::post('/remove-from-starred', [mailbox_controller::class, 'remove_from_starred']);
    Route::post('/add-to-archive', [mailbox_controller::class, 'add_to_archive']);
    Route::post('/remove-from-archive', [mailbox_controller::class, 'remove_from_archive']);
    Route::post('/add-to-trash', [mailbox_controller::class, 'add_to_trash']);
    Route::post('/remove-from-trash', [mailbox_controller::class, 'remove_from_trash']);
    Route::post('/delete-email', [mailbox_controller::class, 'delete_email']);
});

Route::get('/public', function () {return view('public');});
Route::get('/resources', function () {return view('resources/');});
Route::fallback(function () {return view('error/404');});

//home
Route::get('/home', function () {return view('home');})->name('home');
Route::redirect('/', '/home');

//send email
Route::post('/post-email', [mailbox_controller::class, 'handling_post_email']);



