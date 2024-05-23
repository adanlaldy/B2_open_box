<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - Open Box</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://127.0.0.1:8000/css/auth.css" rel="stylesheet">
    <link href="http://127.0.0.1:8000/images/open_box_logo.png" rel="icon">

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
            <form action="/new-password" method="post">
                @csrf
                <input class="form-control mb-3" type="password" name="password" placeholder="New password" autocomplete="">
                {{ $errors->first('password') }}
                <input class="form-control mb-3" type="password" name="password_confirmation" placeholder="New password confirmation" autocomplete="">
                {{ $errors->first('password_confirmation') }}
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Create a new password</button><br>
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
