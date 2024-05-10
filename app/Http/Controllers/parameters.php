<?php

namespace App\Http\Controllers;

class parameters
{
    public function parameters(Language $language)
    {
        return view('mailbox/parameters', compact('language'));
    }

    public function change_language(Language $language)
    {
        $language->$_POST['language']();
        return redirect()->back();
    }
}
