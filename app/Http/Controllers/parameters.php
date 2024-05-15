<?php

namespace App\Http\Controllers;

use http\Env\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class parameters
{
    public function parameters(string $locale)
    {
        if (! in_array($locale, ['en', 'es', 'fr','ru','de','cn'])) {
            abort(400);
        }
        App::setLocale($locale);

        return view('mailbox/parameters');
    }

    public function formParameters(\Illuminate\Http\Request $request)
    {
        $lang = $request->input('lang');

        app()->setLocale($lang);

        $newUrl = URL::to("$lang/parameters");

        return redirect($newUrl);

    }
}
