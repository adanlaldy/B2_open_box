<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class main_controller
{
    public function main(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('mail');
    }
}
