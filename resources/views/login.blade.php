<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link href="http://127.0.0.1:8000/css/auth.css" rel="stylesheet" />

</head>
<body>
<main>
    <section>
        <div class="left">
            <a href="/home"><h1 class="title">Login</h1></a>
            <form action="{{route('auth.login')}}" method="post">
                @csrf
                <input type="email" name="email" placeholder="Email"><br>
                {{ $errors->first('email')}}
                <input type="password" name="password" placeholder="Password"><br>
                {{ $errors->first('password')}}
                <button type="submit">Register</button><br>
                <a href="/register">Not account, Create now ! </a>
            </form>
        </div>

        <div class="right">
            <img class="register" src="http://127.0.0.1:8000/images/secure.png" alt="Description de l'image">
        </div>
    </section>
</main>
</body>
</html>
