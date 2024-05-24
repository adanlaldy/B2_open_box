<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('index.title')</title>
    <link href="http://127.0.0.1:8000/images/open_box_logo.png" rel="icon">
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
                <li><a class="nav-link margin-20 color1" href="/{{ Session::get('locale') }}/sents"><i class="fi fi-ss-paper-plane"></i>@lang('index.sent')</a></li>
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
        <form action="/admin" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="email" placeholder="Entrez l'email de l'utilisateur" aria-label="Email" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Rechercher</button>
            </div>
        </form>

        <div id="search-result">
            @if($user)
                <p>Prénom : {{ $user->first_name }}</p>
                <p>Nom : {{ $user->last_name }}</p>
                <p>Email : {{ $user->email }}</p>
                <p>anniversaire : {{ $user->birthday }}</p>
            @else
                <p>Aucun utilisateur trouvé</p>
            @endif
        </div>
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
