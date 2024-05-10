<?php

use App\Http\Controllers\auth_controller;
use App\Http\Controllers\Language;
use App\Http\Controllers\mailbox_controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailboxController;
use Illuminate\Support\Facades\Route;

$lang = 'en'; // Par exemple, anglais par défaut
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
//    $language = new Language();
}


//native

Route::middleware(['App\Http\Middleware\IfDisconnected'])->group(function () {
    //auth
    Route::get('/register', [AuthController::class, 'formRegister'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'handlingRegister']);
    Route::get('/login', [AuthController::class, 'formLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'handlingLogin']);
});

Route::middleware(['App\Http\Middleware\IfConnected'])->group(function () {
    //logout
    Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    //mailbox
    Route::get('/inbox', [MailboxController::class, 'formInbox'])->name('inbox.index');
    Route::post('/inbox', [MailboxController::class, 'handlingInbox'])->name('inbox.index');
    Route::get('/starreds', [MailboxController::class, 'formStarreds'])->name('inbox.starreds');
    Route::get('/sents', [MailboxController::class, 'formSents'])->name('inbox.sents');
    Route::get('/drafts', [MailboxController::class, 'formDrafts'])->name('inbox.drafts');
    Route::get('/trashes', [MailboxController::class, 'formTrashes'])->name('inbox.trashes');
    Route::get('/spams', [MailboxController::class, 'formSpams'])->name('inbox.spams');
    Route::get('/archives', [MailboxController::class, 'formArchives'])->name('inbox.archives');
    Route::get('/all-emails', [MailboxController::class, 'formAllEmails'])->name('inbox.allEmails');
    Route::get('/parameters', [MailboxController::class, 'parameters'])->name('inbox.parameters');
    //actions
    Route::post('/add-to-starreds', [MailboxController::class, 'addToStarreds']);
    Route::post('/remove-from-starreds', [MailboxController::class, 'removeFromStarreds']);
    Route::post('/add-to-archives', [MailboxController::class, 'addToArchives']);
    Route::post('/remove-from-archives', [MailboxController::class, 'removeFromArchives']);
    Route::post('/add-to-trashes', [MailboxController::class, 'addToTrashes']);
    Route::post('/remove-from-trashes', [MailboxController::class, 'removeFromTrashes']);
    Route::post('/delete-email', [MailboxController::class, 'deleteEmail']);
});

Route::get('/public', function () {
    return view('public');
});
Route::get('/resources', function () {
    return view('resources/');
});
Route::fallback(function () {
    return view('error/404');
});

// home
Route::get('/home', function () {
    return view('home');
})->name('home');
Route::redirect('/', '/home');

// send email
Route::post('/post-email', [MailboxController::class, 'handlingPostEmail']);
