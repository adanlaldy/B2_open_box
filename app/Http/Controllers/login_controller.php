<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class login_controller extends Controller
{
    public function login(){
        return view('login');
    }

    public function DoLogin(LoginRequest $request){
        return redirect('/main');
    }
//    public function handling(){
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
//    }
}
