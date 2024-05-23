<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;


class parameters
{
    public function parameters(string $locale): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = auth()->user();

        if (! in_array($locale, ['en', 'es', 'fr','ru','de','cn'])) {
            abort(400);
        }
        App::setLocale($locale);

        return view('mailbox/parameters', compact('user'));
    }

    public function formParameters(Request $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $lang = $request->input('lang');

        app()->setLocale($lang);
        Session::put('locale', $lang);


        $newUrl = URL::to("$lang/parameters");

        return redirect($newUrl);

    }
}
