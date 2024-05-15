<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="http://127.0.0.1:8000/css/app.css" rel="stylesheet" />
        <title>Open Box</title>
        <favicon href="http://127.0.0.1:8000/images/open_box_logo.png" rel="icon"></favicon>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="{{route('auth.register', ['locale' => 'en'])}}">register</a></li>
                    <li><a href="{{route('auth.login', ['locale' => 'en'])}}">login</a></li>
                </ul>
            </nav>

            <h1>Welcome to Open Box<br> the new email messaging of moments </h1>
            @lang('messages.welcome')
            <div class="waves"></div>
        </header>
        <main>
            <article>
                <img width="500px" src="http://127.0.0.1:8000/images/open_source.png" alt="img open source vector">
                <h2>this website is totally open source </h2>
            </article>

            <article>
                <h2>this website is totally secure </h2>
                <img width="500px" src="http://127.0.0.1:8000/images/secure.png" alt="Description de l'image">
            </article>

        </main>
        <footer>
            <p>&copy; 2024 Open Box</p>
        </footer>
    </body>


</html>
