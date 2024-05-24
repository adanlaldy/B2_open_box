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
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required'],
            'question_recuperation' => ['required'],
            'response_recuperation' => ['required'], 
            'birthDate' => ['required'],
        ]);

        // create new user
        User::create([
            'first_name' => $validatedData['firstName'],
            'last_name' => $validatedData['lastName'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'question_recuperation' => $validatedData['question_recuperation'],
            'response_recuperation' => $validatedData['response_recuperation'],
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

    public function formForgotPassword()
    {
        return view('authentication.forgot_password');
    }

    public function handlingForgotPassword()
    {
        $validatedData = request()->validate([
            'email' => ['required', 'email'],
        ]);

        // Check if email exists
        $user = User::where('email', $validatedData['email'])->first();

        if ($user) {
            // Store email and question in session
            session(['email' => $validatedData['email']]);
            session(['questionRecuperation' => $user->question_recuperation]);

            // Redirect to reset password page
            return redirect()->route('reset-password-form');
        } else {
            return back()->withInput()->withErrors([
                'email' => 'The provided email does not exist.',
            ]);
        }
    }

    public function formResetPassword()
    {
        // Retrieve the question from the session
        $questionRecuperation = session('questionRecuperation');

        if (!$questionRecuperation) {
            return redirect()->route('forgot-password');
        }

        return view('authentication.reset_password', compact('questionRecuperation'));
    }

    public function handlingResetPassword()
    {
        // Validate the response
        $validatedData = request()->validate([
            'response' => ['required', 'string'],
        ]);

        $email = session('email');
        $user = User::where('email', $email)->first();

        if ($user && $user->response_recuperation == $validatedData['response']) {
            // The response is correct, proceed to reset password or any other logic
            return redirect()->route('new-password-form');
        } else {
            return back()->withInput()->withErrors([
                'response' => 'The provided answer is incorrect.',
            ]);
        }
    }

    public function formNewPassword()
    {
        return view('authentication.new_password');
    }

    public function handlingNewPassword()
    {
        // validate the password
        $validatedData = request()->validate([
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required'],
        ]);

        // collect user
        $user = User::where('email', session('email'))->first();

        if ($user) {
            // update password
            $user->update([
                'password' => bcrypt($validatedData['password']),
            ]);

            // redirect to login page
            $locale = 'en'; // Assurez-vous que 'locale' est stocké en session ou récupérer autrement
            return redirect()->route('auth.login', ['locale' => $locale])->with('success', 'Your password has been successfully reset. You can now log in with your new password.');        
        } else {
            // error message
            return back()->withInput()->withErrors([
                'password' => 'The passwords are not same.', // failed -> redirect to previous page
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
