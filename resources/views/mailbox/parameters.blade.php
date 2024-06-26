<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('index.title')</title>
    <favicon href="http://127.0.0.1:8000/images/open_box_logo.png" rel="icon"></favicon>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="http://127.0.0.1:8000/css/mail.css" rel="stylesheet" />
    <link href="http://127.0.0.1:8000/css/colors.css" rel="stylesheet" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
</head>
<body>
<main>
    <!-- Top Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
        <div class="container-fluid d-flex justify-content-between align-items-center container-fluid-custom color3 p-0">
            <!-- menu hamburger -->
            <nav class="navbar navbar-light bg-light d-lg-none">
                <div class="container-fluid">
                    <button class="navbar-toggler custom-toggler" type="button" onclick="toggleSidebar()">
                        <span class="navbar-toggler-icon m-1"></span>
                    </button>
                </div>
            </nav>
            <form class="form-inline my-2 my-lg-0 mx-auto" action="/search" method="post">
                @csrf
                <div class="input-group center">
                    <input class="form-control mr-sm-2" name="query" type="search" placeholder="@lang('index.search_placeholder')" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">@lang('index.search_button')</button>
                </div>
            </form>

            <div class="navbar-nav d-lg-flex flex-row align-items-center">
                <ul class="navbar-nav d-flex flex-row">
                    <li class="nav-item d-lg-block d-none"><a class="nav-link top" href="/{{ Session::get('locale') }}/offers"><i class="fi fi-sr-wallet"></i>@lang('index.subscription')</a></li>
                    <li class="nav-item d-lg-block d-none"><a class="nav-link top" href="/{{ Session::get('locale') }}/parameters"><i class="fi fi-ss-settings"></i>@lang('index.parameters')</a></li>
                </ul>
                <form action="{{ route('auth.logout') }}" method="post" class="d-lg-block d-none">
                    @csrf
                    @method('delete')
                    <button type="submit" class="nav-link pt-2 top"><i class="fi fi-sr-exit"></i>@lang('index.logout')</button>
                </form>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-light color3 p-0">
        <div class="container-fluid d-flex justify-content-between align-items-center container-fluid-custom color3 p-0">
            <h1 class="form-inline my-2 my-lg-0 margin-50">@lang('index.sent')</h1>
        </div>
    </nav>
    <!-- Sidebar -->
    <div class="sidebar color1">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <nav>
            <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto nav-link margin-20" href="/{{ Session::get('locale') }}/inbox">
                <img class="logo" width="50px" style="margin: 0 30px 0 0; border-radius: 20%" src="http://127.0.0.1:8000/images/open_box_logo.png" alt="logo">
                {{ $user->email }}
            </a>

            <hr class="bar-menu">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item d-lg-none"><a class="nav-link color1" href="/{{ Session::get('locale') }}/offers"><i class="fi fi-sr-wallet"></i>@lang('index.subscription')</a></li>
                <hr class="bar-menu nav-item d-lg-none">
                <li class="nav-item"><a class="nav-link color1" href="/{{ Session::get('locale') }}/inbox"><i class="fi fi-sr-envelope-open"></i>@lang('index.inbox')</a></li>
                <li><a class="nav-link color1" href="/{{ Session::get('locale') }}/drafts"><i class="fi fi-ss-edit"></i>@lang('index.draft')</a></li>
                <li><a class="nav-link color1" href="/{{ Session::get('locale') }}/sents"><i class="fi fi-ss-paper-plane"></i>@lang('index.sent')</a></li>
                <li><a class="nav-link color1" href="/{{ Session::get('locale') }}/starreds"><i class="fi fi-sr-star"></i>@lang('index.star')</a></li>
                <li><a class="nav-link color1" href="/{{ Session::get('locale') }}/archives"><i class="fi fi-sr-bookmark"></i>@lang('index.archive')</a></li>
                <li><a class="nav-link color1" href="/{{ Session::get('locale') }}/spams"><i class="fi fi-ss-shield-exclamation"></i>@lang('index.spam')</a></li>
                <li><a class="nav-link color1" href="/{{ Session::get('locale') }}/trashes"><i class="fi fi-sr-trash"></i>@lang('index.trash')</a></li>
                <li><a class="nav-link color1" href="/{{ Session::get('locale') }}/all-emails"><i class="fi fi-sr-apps"></i>@lang('index.all_mail')</a></li>
                <hr class="bar-menu nav-item d-lg-none">
                <li class="nav-item d-lg-none"><a class="nav-link color1" href="/{{ Session::get('locale') }}/parameters"><i class="fi fi-ss-settings"></i>@lang('index.parameters')</a></li>
                <hr class="bar-menu nav-item d-lg-none">
                <form action="{{route('auth.logout')}}" method="post" class="d-lg-none">
                    @csrf
                    @method('delete')
                    <button type="submit" class="nav-link pt-4 color1"><i class="fi fi-sr-exit"></i>@lang('index.logout')</button>
                </form>
            </ul>
        </nav>
    </div>
    <div class="overlay"></div>
    <!-- Contenu des paramètres -->
    <div class="content">
        <div class="container mt-4">
            <h1>Paramètres</h1>
            <hr>

            <h2>Langue</h2>
            <p>Choisissez votre langue</p>
            <form action="" method="post">
                @csrf
                <select name="lang" id="lang">
                    <option value="fr" {{ App::getLocale() == 'fr' ? 'selected' : '' }}>french</option>
                    <option value="en" {{ App::getLocale() == 'en' ? 'selected' : '' }}>english</option>
                    <option value="ru" {{ App::getLocale() == 'ru' ? 'selected' : '' }}>russian</option>
                    <option value="es" {{ App::getLocale() == 'es' ? 'selected' : '' }}>spanish</option>
                    <option value="de" {{ App::getLocale() == 'de' ? 'selected' : '' }}>german</option>
                    <option value="cn" {{ App::getLocale() == 'cn' ? 'selected' : '' }}>chinoise</option>
                </select>
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>

            <h2>Theme</h2>
            <p>Choisissez votre thème</p>
            <!-- Ajoutez des boutons ou des événements pour appeler les fonctions JavaScript -->
<button onclick="removeColor1Class()">naturel</button>
<button onclick="restoreColor1Class()">ciel epure</button>


            <h2>Compte</h2>
            <p>Modifier votre compte</p>

            <form action="" method="post">
                @csrf
                <label for="name">name</label>
                <input type="text" name="first_name" id="name" value="{{ Auth::user()->first_name }}" class="form-control mb-3">
                <label for="last_name">last_name</label>
                <input type="text" name="first_name" id="last_name" value="{{ Auth::user()->last_name }}" class="form-control mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="form-control mb-3">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control mb-3">
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
            <br>
            <form action="" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Supprimer le compte</button>
            </form>
            <p>Attention, cette action est irréversible</p>


            <h2>droits</h2>
            <a href="/{{ Session::get('locale', app()->getLocale()) }}/cgu">Cgu</a> <br>
            <a href="/{{ Session::get('locale', app()->getLocale()) }}/cgv">Cgv</a> <br>
            <a href="/{{ Session::get('locale', app()->getLocale()) }}/confidentialite">Mentions légales</a>

            <h2>Version</h2>
            <?php
            // Dans votre code PHP (par exemple, un contrôleur ou une vue)
            $version = config('version.version');
            ?>
            <p class="txt-color1">Version actuelle : {{ $version }}</p>

        </div>
    </div>
</main>

<!-- Bootstrap JS et dépendances -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

<script>
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.overlay');
        sidebar.classList.toggle('active');
        overlay.style.display = (sidebar.classList.contains('active')) ? 'block' : 'none';
    }

    document.querySelector('.overlay').addEventListener('click', function() {
        toggleSidebar(); // Désactiver le menu
    });
</script>
</body>
</html>

<script>
  // Fonction pour enlever la classe color1 des éléments
function removeColor1Class() {
    var elements = document.querySelectorAll('.color1');
    elements.forEach(function(element) {
        // Stocker la classe color1 actuelle dans un attribut de données HTML
        element.setAttribute('data-color1', 'true');
        element.classList.remove('color1');
    });
}

// Fonction pour restaurer la classe color1 aux éléments qui avaient la classe color1 précédemment
function restoreColor1Class() {
    var elements = document.querySelectorAll('[data-color1="true"]');
    elements.forEach(function(element) {
        // Réajouter la classe color1
        element.classList.add('color1');
        // Supprimer l'attribut de données HTML
        element.removeAttribute('data-color1');
    });
}

</script>
