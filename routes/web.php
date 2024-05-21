<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailboxController;
use App\Http\Controllers\parameters;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


//auth
Route::get('/{locale}/register', [AuthController::class, 'formRegister'])->name('auth.register');
Route::post('/{locale}/register', [AuthController::class, 'handlingRegister']);
Route::get('/{locale}/login', [AuthController::class, 'formLogin'])->name('auth.login');
Route::post('/{locale}/login', [AuthController::class, 'handlingLogin']);

// cgu
Route::get('/{locale}/cgu', function (string $locale) {
    if (! in_array($locale, ['en', 'es', 'fr', 'ru', 'de', 'cn'])) {
        abort(400);
    }
    App::setLocale($locale);

    return view('cgu');
})->name('cgu');

Route::get('/{locale}/confidentialite', function (string $locale) {
    if (! in_array($locale, ['en', 'es', 'fr', 'ru', 'de', 'cn'])) {
        abort(400);
    }
    App::setLocale($locale);

    return view('confidentialite');
})->name('confidentialite');

Route::get('/{locale}/cgv', function (string $locale) {
    if (! in_array($locale, ['en', 'es', 'fr', 'ru', 'de', 'cn'])) {
        abort(400);
    }
    App::setLocale($locale);

    return view('cgv');
})->name('cgv');


Route::get('/{locale}/offers', function (string $locale) {
    if (! in_array($locale, ['en', 'es', 'fr', 'ru', 'de', 'cn'])) {
        abort(400);
    }
    App::setLocale($locale);
    $user = auth()->user(); // collect connected user


    return view('mailbox/offers', compact('user'));
})->name('offers');



Route::middleware(['App\Http\Middleware\IfConnected'])->group(function () {
    //logout
    Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    //mailbox
    Route::get('/{locale}/inbox', [MailboxController::class, 'formInbox'])->name('inbox.index');
    Route::post('/{locale}/inbox', [MailboxController::class, 'handlingInbox'])->name('inbox.index');
    Route::get('/{locale}/starreds', [MailboxController::class, 'formStarreds'])->name('inbox.starreds');
    Route::get('/{locale}/sents', [MailboxController::class, 'formSents'])->name('inbox.sents');
    Route::get('/{locale}/drafts', [MailboxController::class, 'formDrafts'])->name('inbox.drafts');
    Route::get('/{locale}/trashes', [MailboxController::class, 'formTrashes'])->name('inbox.trashes');
    Route::get('/{locale}/spams', [MailboxController::class, 'formSpams'])->name('inbox.spams');
    Route::get('/{locale}/archives', [MailboxController::class, 'formArchives'])->name('inbox.archives');
    Route::get('/{locale}/all-emails', [MailboxController::class, 'formAllEmails'])->name('inbox.allEmails');
    Route::get('/{locale}/parameters', [parameters::class, 'parameters'])->name('inbox.parameters');
    Route::post('/{locale}/parameters', [parameters::class, 'formParameters'])->name('inbox.parameters');

    //actions
    Route::post('/add-to-starreds', [MailboxController::class, 'addToStarreds']);
    Route::post('/remove-from-starreds', [MailboxController::class, 'removeFromStarreds']);
    Route::post('/add-to-archives', [MailboxController::class, 'addToArchives']);
    Route::post('/remove-from-archives', [MailboxController::class, 'removeFromArchives']);
    Route::post('/add-to-trashes', [MailboxController::class, 'addToTrashes']);
    Route::post('/remove-from-trashes', [MailboxController::class, 'removeFromTrashes']);
    Route::post('/delete-email', [MailboxController::class, 'deleteEmail']);
    // send email
    Route::post('/post-email', [MailboxController::class, 'handlingPostEmail']);
});
Route::get('/fill', [AuthController::class, 'fill']);
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
Route::get('/{locale}/home', function (string $locale) {
    if (! in_array($locale, ['en', 'es', 'fr'])) {
        abort(400);
    }
    App::setLocale($locale);

    return view('home');
})->name('home');


Route::redirect('/ester-egg', 'https://elgoog.im/dinosaur-game/3d/');


Route::redirect('/', '/en/home');


Session::put('locale', 'en');
