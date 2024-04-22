<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>register</title>
</head>
<style>
    body {
        font-family: 'Nunito', sans-serif;
        margin: 0;
    }
    main {
        padding: 20px;
    }
    h1 {
        text-align: center;
        color: #0058a1;
        font-family: Roboto, sans-serif;
        font-size: 35px;
        margin: 0 0 200px 0;
    }
    section {
        display: flex;
        justify-content: center;
        margin: 100px auto auto;
        border-radius: 25px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        height: auto;
        width: 80vw;
    }
    .left {
        width: 50%;
        padding: 20px;
        Height: auto;
    }
    .right {
        background-color: #fafafa;
        border-radius: 0 25px 25px 0;
        text-align: center;
        width: 70%;
        padding: 20px;

    }
    .center {
        text-align: center;
    }
    input {
        width: 80%;
        padding: 10px;
        margin: 10px 0;
    }
    button {
        padding: 10px;
        background-color: #0058a1;
        color: #fff;
        border: none;
        cursor: pointer;
    }
    button:hover {
        background-color: #003366;
    }
    a {
        color: #fff;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
    .name {
        width: 35%;
        margin: 0 20px 10px 0;
    }

    .register {
        width: 80%;
    }
</style>
<body>
<main>
    <section>
        <div class="left">
            <a href="/"><h1 class="title">Resgister</h1></a>
            <form action="{{route('auth.register')}}" method="post">
                @csrf
                <input class="name" type="text" name="name" placeholder="First Name">
                <input class="name" type="text" name="name" placeholder="Last Name"> <br>
                <input type="email" name="email" placeholder="Email"><br>
                {{ $errors->first('email')}}
                <input type="password" name="password" placeholder="Password"><br>
                {{ $errors->first('password')}}
                <button type="submit">Register</button><br>
                <p>Already have an account? <a href="/login">Login</a></p>
            </form>
        </div>

        <div class="right">
            <img class="register" src="http://127.0.0.1:8000/images/secure.png" alt="Description de l'image">
        </div>
    </section>
</main>
</body>
</html>
