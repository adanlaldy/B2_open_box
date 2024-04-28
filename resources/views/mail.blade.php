<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>mail</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/register">register</a></li>
        </ul>
        <p> Adress : {{ Auth::user()->email }} </p>

        <form action="{{route('auth.logout')}}" method="post">
            @csrf
            @method('delete')
            <button type="submit">Logout</button>
        </form>
    </nav>
</header>
</body>
