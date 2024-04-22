<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Open Box</title>
    </head>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
        }
        header {
            height: 100vh;
            width: 100%;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            background: url("http://127.0.0.1:8000/images/background.jpg") no-repeat center center;
            background-size: cover;
            box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.6);
        }

        /*header::after {*/
        /*    content: '';*/
        /*    position: absolute;*/
        /*    bottom: -20px;*/
        /*    left: 0;*/
        /*    width: 100%;*/
        /*    height: 100px; !* Ajuster la hauteur du dégradé selon vos besoins *!*/
        /*    background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgb(255, 255, 255) 100%);*/
        /*}*/

        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 10px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        main {
            padding: 20px;
        }
        footer {
            background-color: #161923;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            bottom: 0;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #ffffff;
            font-size: 56px;
            margin-top: 30vh;
            font-family: "Berlin Sans FB", serif;

        }

        article {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 100px;
        }

        h2 {
            font-size: 32px;
            font-weight: 800;
            color: #002157;
            font-family: "Berlin Sans FB", serif;
        }

        .center {
            text-align: center;
        }

        .waves {
            position: absolute;
            bottom: -20px;
            left: 0;
            width: 100%;
            height: 15vh;
            background: url("http://127.0.0.1:8000/images/wave.png");
        }

    </style>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/register">register</a></li>
                </ul>
            </nav>

            <h1>Welcome to Open Box<br> the new email messaging of moments </h1>
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
