<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\User;

class AdminController extends Controller
{
    //

    public function formAdmin($locale)
    {
        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);

        $user = auth()->user();

        return view('mailbox/admin', compact('user'));
    }

    public function searchUser(Request $request)
    {
        $email = request()->input('email');
        $user = User::where('email', $email)->first();
        return view('mailbox/admin', compact('user'));
    }
}
