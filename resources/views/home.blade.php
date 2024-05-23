<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://127.0.0.1:8000/css/app.css" rel="stylesheet" />
    <link href="http://127.0.0.1:8000/css/colors.css" rel="stylesheet" />
    <link href="http://127.0.0.1:8000/images/open_box_logo.png" rel="icon">
    <title>Open Box</title>
    <link href="http://127.0.0.1:8000/images/open_box_logo.png" rel="icon">
</head>
<body>
<header>
    <div class="shadow"></div>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="/">Open Box</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.register', ['locale' => 'en']) }}">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.login', ['locale' => 'en']) }}">Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container text-center">
        <h1 class="txt-color3">Welcome to Open Box<br> the new email messaging of moments</h1>
        <div class="waves"></div>
    </div>
</header>
<main class="container my-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card text-center shadow-sm">
                <img class="card-img-top img-fluid" src="http://127.0.0.1:8000/images/open_source.png" alt="Open source image">
                <div class="card-body">
                    <h5 class="card-title">This website is totally open source</h5>
                    <p class="card-text">Our code is available for everyone to review and contribute to, ensuring transparency and community collaboration.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card text-center shadow-sm">
                <img class="card-img-top img-fluid" src="http://127.0.0.1:8000/images/secure.png" alt="Secure image">
                <div class="card-body">
                    <h5 class="card-title">This website is totally secure</h5>
                    <p class="card-text">We prioritize your privacy and security with top-notch measures to protect your data at all times.</p>
                </div>
            </div>
        </div>
    </div>
</main>
<footer class="bg-light py-3 mt-4">
    <div class="container text-center">
        <p>&copy; 2024 Open Box</p>
    </div>
</footer>
<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
