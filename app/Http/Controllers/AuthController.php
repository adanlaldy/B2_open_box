<?php

namespace App\Http\Controllers;

use App\Models\User;

class AuthController extends Controller
{
    // get register
    public function formRegister()
    {
        return view('authentication/register');
    }

    // post register
    public function handlingRegister()
    {
        // check if inputs are correctly filled
        $validatedData = request()->validate([
            'firstName' => ['required'],
            'lastName' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:2'],
            'birthDate' => ['required'],
        ]);

        // create new user
        User::create([
            'first_name' => $validatedData['firstName'],
            'last_name' => $validatedData['lastName'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'question_recuperation' => 'question',
            'response_recuperation' => 'response',
            'birthday' => $validatedData['birthDate'],
        ]);

        // connection attempt
        if (auth()->attempt([
            'email' => request('email'),
            'password' => request('password'),
        ])) {
            request()->session()->regenerate();

            return redirect()->intended(route('inbox.index')); // succeeds -> redirect to inbox page
        } else {
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
    public function formLogin()
    {
        return view('authentication/login');
    }

    // post login
    public function handlingLogin()
    {
        // check if email has good format and input is filled
        $validatedData = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // connection attempt
        if (auth()->attempt([
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ])) {
            request()->session()->regenerate();

            return redirect()->intended(route('inbox.index')); // succeeds -> redirect to inbox page
        } else {
            return back()->withInput()->withErrors([
                'email' => 'The provided credentials do not match our records.', // failed -> redirect to previous page
            ]);
        }
    }
}
