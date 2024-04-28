<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mailbox_controller extends Controller
{
    public function inbox()
    {
        return view('mailbox/inbox');
    }
}
