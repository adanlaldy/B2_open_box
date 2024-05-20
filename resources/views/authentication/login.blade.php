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
    <style>
        main {
            display: flex;
            min-height: 100vh; /* Ensures full viewport height */
            justify-content: center; /* Centers content horizontally */
            align-items: center; /* Centers content vertically */
        }
    </style>
    <main class=" mx-auto d-flex justify-content-center align-items-center vh-100">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <section class="row d-flex justify-content-center align-items-center mb-0">
                <div class="col-lg-6 order-lg-1 mt-auto mb-auto">
                <a href="/{{ Session::get('locale', app()->getLocale()) }}/home"><h1 class="title">Connexion</h1></a>
                <form action="{{route('auth.login', ['locale' => 'en'])}}" method="post">
                    @csrf
                    <input type="email" name="email" placeholder="Email" class="form-control"><br>
                    {{ $errors->first('email')}}
                    <input type="password" name="password" placeholder="Password" class="form-control"><br>
                    {{ $errors->first('password')}}
                    <a href="/{{ Session::get('locale', app()->getLocale()) }}/register">pas encore de compte ? crée en un ! </a><br>
                    <div class="text-center"> <!-- Ajout de la classe text-center pour centrer le contenu -->
                        <button type="submit" class="btn btn-primary">se connecter</button><br>
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
