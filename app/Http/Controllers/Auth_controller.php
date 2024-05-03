<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class auth_controller extends Controller
{
    // get register
    public function form_register()
    {
        return view('authentication/register');
    }

    // post register
    public function handling_register()
    {
        // check if inputs are correctly filled
        request()->validate([
        'first_name' => ['required'],
        'last_name' => ['required'],
        'birth_date' => ['required'],
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'min:2'],
        ]);
        // create new user
        $user = User::create([
        'first_name' => request('first_name'),
        'last_name' => request('last_name'),
        'email' => request('email'),
        'password' => bcrypt(request('password')),
        'question_recuperation' => 'question',
        'response_recuperation' => 'response',
        'birthday' => request('birth_date'),
        ]);
        if(auth()->attempt([
            'email' => request('email'),
            'password' => request('password'),
        ])){
            request()->session()->regenerate();
            return redirect()->intended(route('inbox.index')); // succeeds -> redirect to inbox page
        }else{
            return back()->withInput()->withErrors([
                'email' => 'The provided credentials already exists.', // failed -> redirect to previous page
            ]);
        }
    }

    // logout
    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }

    // get login
    public function form_login()
    {
        return view('authentication/login');
    }

    // post login
    public function handling_login()
    {
        // check if email has good format and input is filled
        request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // connection attempt
        if(auth()->attempt([
            'email' => request('email'),
            'password' => request('password'),
        ])){
            request()->session()->regenerate();
            return redirect()->intended(route('inbox.index')); // succeeds -> redirect to inbox page
        }else{
            return back()->withInput()->withErrors([
                'email' => 'The provided credentials do not match our records.', // failed -> redirect to previous page
            ]);
        }
    }
}
