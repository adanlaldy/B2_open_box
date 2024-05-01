<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Auth_controller extends Controller
{
    // register
    public function registration(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->create_table_user();
        return view('authentification/register');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function doRegister(RegisterRequest $request): RedirectResponse
    {
        $name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $date_of_birth = $request->input('birth_date');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $about = $request->input('about');

        $this->create_table_user();
        $this->add_user($name, $last_name, $date_of_birth, $email, $password, $about);

        $credentials = $request->validated();

        if (auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('inbox.index'));
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    // login
    public function login(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('authentification/login');
    }

    public function DoLogin(LoginRequest $request): RedirectResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::loginUsingId($this->get_id_user_by_email($email))) {
            return redirect()->intended(route('inbox.index'));
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    // bdd
    public function create_table_user(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id SERIAL PRIMARY KEY,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            date_of_birth DATE NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            about VARCHAR(255) NOT NULL
        )";
        DB::statement($sql);
    }

    public function add_user($name, $last_name, $date_of_birth, $email, $password, $about): void
    {
        $sql = "INSERT INTO users (first_name, last_name, date_of_birth, email, password, about) VALUES ('$name', '$last_name', '$date_of_birth', '$email', '$password', '$about')";
        DB::statement($sql);
    }

    public function get_id_user_by_email(string $email): int
    {
        $sql = "SELECT id FROM users WHERE email = '$email'";
        return DB::select($sql)[0]->id;
    }
}
