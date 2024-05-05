<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="http://127.0.0.1:8000/css/auth.css" rel="stylesheet" />
</head>
<body>
<main>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section>
        <div class="left">
            <a href="/home"><h1 class="title">Connexion</h1></a>
            <form action="{{route('auth.login')}}" method="post">
                @csrf
                <input type="email" name="email" placeholder="Email"><br>
                {{ $errors->first('email')}}
                <input type="password" name="password" placeholder="Password"><br>
                {{ $errors->first('password')}}
                <a href="/register">pas encore de compte ? crée en un ! </a><br>
                <button type="submit">se connecter</button><br>

            </form>
        </div>

        <div class="right">
            <img class="register" src="http://127.0.0.1:8000/images/secure.png" alt="Description de l'image">
        </div>
    </section>
</main>
</body>
</html>
