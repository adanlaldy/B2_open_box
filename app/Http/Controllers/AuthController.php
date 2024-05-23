<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\App;

class AuthController extends Controller
{
    // get register
    public function formRegister($locale)
    {

        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);

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

            return redirect()->intended(route('inbox.index', ['locale' => 'en'])); // succeeds -> redirect to inbox page
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

        return redirect()->route('home', ['locale' => 'en']);
    }

    // get login
    public function formLogin($locale)
    {
        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);
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

            return redirect()->intended(route('inbox.index', ['locale' => 'en'])); // succeeds -> redirect to inbox page
        } else {
            return back()->withInput()->withErrors([
                'email' => 'The provided credentials do not match our records.', // failed -> redirect to previous page
            ]);
        }
    }

    // get forgot password
    public function formForgotPassword($locale)
    {
        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);
        return view('authentication/forget');
    }

    // post forgot password
    public function handlingForgotPassword()
    {
        // check if email has good format and input is filled
        $validatedData = request()->validate([
            'email' => ['required', 'email'],
            'birthday' => ['required'],
        ]);

        // check if email exists
        $user = User::where('email', $validatedData['email'])->first();

        if ($user) {
            return redirect()->route('auth.formResetPassword', ['locale' => 'en', 'email' => $validatedData['email']]); // email exists -> redirect to reset password page
        } else {
            return back()->withInput()->withErrors([
                'email' => 'The provided email does not exist.', // email does not exist -> redirect to previous page
            ]);
        }
    }


    public function fill()
    {
        // create new user
        User::create([
            'first_name' => 'a',
            'last_name' => 'a',
            'email' => 'a@a.a',
            'password' => bcrypt('aa'),
            'question_recuperation' => 'question',
            'response_recuperation' => 'response',
            'birthday' => '2000-01-01', // Entourez la date de guillemets
        ]);

        // create new user
        User::create([
            'first_name' => 'b',
            'last_name' => 'b',
            'email' => 'b@b.b',
            'password' => bcrypt('bb'),
            'question_recuperation' => 'question',
            'response_recuperation' => 'response',
            'birthday' => '2000-01-01', // Entourez la date de guillemets
        ]);

        // create new user
        User::create([
            'first_name' => 'c',
            'last_name' => 'c',
            'email' => 'c@c.c',
            'password' => bcrypt('cc'),
            'question_recuperation' => 'question',
            'response_recuperation' => 'response',
            'birthday' => '2000-01-01', // Entourez la date de guillemets
        ]);

        // create new user
        User::create([
            'first_name' => 'd',
            'last_name' => 'd',
            'email' => 'd@d.d',
            'password' => bcrypt('dd'),
            'question_recuperation' => 'question',
            'response_recuperation' => 'response',
            'birthday' => '2000-01-01', // Entourez la date de guillemets
        ]);
    }

}
