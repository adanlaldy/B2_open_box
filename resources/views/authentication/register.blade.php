<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>register</title>
    <link href="http://127.0.0.1:8000/css/auth.css" rel="stylesheet" />
</head>

<body>
<main>
    <section>
        <div class="left">
            <a href="/en/home"><h1 class="title">Resgister</h1></a>
            <form action="{{route('auth.register', ['locale' => 'en'])}}" method="post">
                @csrf
                <input class="name" type="text" name="firstName" placeholder="First Name" autocomplete="">
                <input class="name" type="text" name="lastName" placeholder="Last Name" autocomplete=""> <br>
                <input class="name" type="date" name="birthDate" placeholder="date of birth" autocomplete="">
                <!--<input class="name" type="text" name="about" placeholder="#words (facultatif)" autocomplete=""> <br>-->
                <input type="email" name="email" placeholder="Email" autocomplete=""><br>
                {{ $errors->first('email')}}
                <input type="password" name="password" placeholder="Password" autocomplete=""><br>
                {{ $errors->first('password')}}
                <button type="submit">Register</button><br>
                <a href="/en/login">Already have an account? Login</a>
            </form>
        </div>

        <div class="right">
            <img class="register" src="http://127.0.0.1:8000/images/secure.png" alt="Description de l'image">
        </div>
    </section>
</main>
</body>
</html>
