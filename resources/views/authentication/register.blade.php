<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="http://127.0.0.1:8000/css/auth.css" rel="stylesheet" />
</head>

<body>
<main class="mx-auto d-flex justify-content-center align-items-center vh-100">
    <section class="row d-flex justify-content-center align-items-center mb-0">
        <div class="col-lg-6 order-lg-1 mt-auto mb-auto">
            <a href="/en/home"><h1 class="title">Register</h1></a>
            <form action="{{ route('auth.register', ['locale' => 'en']) }}" method="post">
                @csrf
                <input class="form-control mb-3" type="text" name="firstName" placeholder="First Name" autocomplete="">
                <input class="form-control mb-3" type="text" name="lastName" placeholder="Last Name" autocomplete="">
                <input class="form-control mb-3" type="date" name="birthDate" placeholder="Date of Birth" autocomplete="">
                <input class="form-control mb-3" type="email" name="email" placeholder="Email" autocomplete="">
                {{ $errors->first('email')}}
                <input class="form-control mb-3" type="password" name="password" placeholder="Password" autocomplete="">
                {{ $errors->first('password')}}
                <button type="submit" class="btn btn-primary mb-3">Register</button>
                <a href="/en/login">Already have an account? Login</a>
            </form>
        </div>

        <div class="col-lg-6 order-lg-2 d-none d-lg-block">
            <img class="register img-fluid" src="http://127.0.0.1:8000/images/secure.png" alt="Description de l'image">
        </div>
    </section>
</main>
</body>
</html>
