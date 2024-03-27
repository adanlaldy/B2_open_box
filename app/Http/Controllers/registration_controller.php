<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class registration_controller extends Controller
{
    public function form(){
        return view('registration'); 
    }

    public function handling(){
        // check if inputs are correctly filled
        /*request()->validate([
        'first_name' => ['required'],
        'last_name' => ['required'],
        'email' => ['required', 'email', 'unique:users,email'],
        'phone_number' => ['required', 'digits:10', 'unique:users,phone_number'],
        'password' => ['required', 'confirmed', 'min:8'],
        'password_confirmation' => ['required'],
        ]);
        // create new user
        $user = User::create([
        'first_name' => request('first_name'),
        'last_name' => request('last_name'),
        'email' => request('email'),
        'phone_number' => request('phone_number'),
        'password' => bcrypt(request('password')),
        ]);
        return redirect('/login'); //redirect to login page*/
    }
}
