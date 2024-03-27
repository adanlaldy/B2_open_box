<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function form(){
        return view('login');
    }

    public function handling(){
        /*// check if email has good format and input is filled
        request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // connection attempt
        if (auth()->attempt([
            'email' => request('email'),
            'password' => request('password'),
        ])){
            return redirect('/my-account'); // succeeds -> redirect to logged page
        }else{
            return back()->withInput()->withErrors([
                'email' => 'Your credentials are incorrect.', // failed -> redirect to previous page
            ]);
        }*/
    }
}
