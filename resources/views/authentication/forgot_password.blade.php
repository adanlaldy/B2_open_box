<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password - Open Box</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://127.0.0.1:8000/css/auth.css" rel="stylesheet">
</head>
<body>
<style>
    main {
        display: flex;
        min-height: 100vh;
        justify-content: center;
        align-items: center;
    }
</style>
<main class="mx-auto d-flex justify-content-center align-items-center vh-100">
    <section class="row d-flex justify-content-center align-items-center mb-0">
        <div class="col-lg-6 order-lg-1 mt-auto mb-auto">
            <h1 class="title">Recover your password</h1>
            <form action="/forgot-password" method="post">
                @csrf
                <input type="email" name="email" placeholder="Email" class="form-control"><br>
                {{ $errors->first('email') }}
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">See the question recuperation</button><br>
                </div>
            </form>
        </div>
        <div class="col-lg-6 order-lg-2 d-none d-lg-block">
            <img class="register img-fluid" src="http://127.0.0.1:8000/images/secure.png" alt="Description de l'image">
        </div>
    </section>
</main>
</body>
</html>
