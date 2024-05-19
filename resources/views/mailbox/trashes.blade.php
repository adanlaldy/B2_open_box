<!DOCTYPE html>
<html lang="@lang('fr')">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('Trash') - @lang('Open Box')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="http://127.0.0.1:8000/css/mail.css" rel="stylesheet" />
</head>
<body>
<main>
    <!-- Top Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid d-flex justify-content-between align-items-center container-fluid-custom">
            <!-- menu hamburger -->
            <nav class="navbar navbar-light bg-light d-lg-none">
                <div class="container-fluid">
                    <button class="navbar-toggler custom-toggler" type="button" onclick="toggleSidebar()">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
            <form class="form-inline my-2 my-lg-0 mx-auto">
                <div class="input-group center">
                    <input class="form-control mr-sm-2" type="search" placeholder="@lang('index.search_placeholder')" aria-label="Search">
                    <button class="btn btn-outline-success " type="submit">@lang('index.search')</button>
                </div>
            </form>

            <div class="navbar-nav d-lg-flex flex-row align-items-center">
                <ul class="navbar-nav d-flex flex-row">
                    <li class="nav-item d-lg-block d-none"><a class="nav-link" href="/offers">@lang('index.subscription')</a></li>
                    <li class="nav-item d-lg-block d-none"><a class="nav-link" href="/parameters">@lang('index.parameters')</a></li>
                </ul>
                <form action="{{route('auth.logout')}}" method="post"> <!-- Suppression de la classe "ms-3" pour centrer correctement le bouton sur mobile -->
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-link nav-item d-lg-block d-none">@lang('index.logout')</button>
                </form>
            </div>
        </div>

    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid d-flex justify-content-between align-items-center container-fluid-custom">
            <h1 class="form-inline my-2 my-lg-0 margin-50">@lang('index.title')</h1>
        </div>
    </nav>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav>
            <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none margin-20" href="/inbox">@lang('Open Box') <?php echo Auth::user()->email; ?></a>
            <hr class="bar-menu">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item d-lg-none"><a class="nav-link" href="/en/offers">@lang('index.subscription')</a></li> <!-- Ajout de la classe "d-lg-none" pour cacher en mode PC -->
                <hr class="bar-menu nav-item d-lg-none">
                <li class="nav-item"><a class="nav-link" href="/en/inbox">@lang('index.inbox')</a></li>
                <li><a class="nav-link link-body-emphasis" href="/en/drafts">@lang('index.draft')</a></li>
                <li><a class="nav-link link-body-emphasis" href="/en/sents">@lang('index.sent')</a></li>
                <li><a class="nav-link link-body-emphasis" href="/en/starreds">@lang('index.star')</a></li>
                <li><a class="nav-link link-body-emphasis" href="/en/archives">@lang('index.archive')</a></li>
                <li><a class="nav-link link-body-emphasis" href="/en/spams">@lang('index.spam')</a></li>
                <li><a class="nav-link active margin-20" href="/en/trashes">@lang('index.trash')</a></li>
                <li><a class="nav-link link-body-emphasis" href="/en/all-emails">@lang('index.all_mail')</a></li>
                <hr class="bar-menu nav-item d-lg-none">
                <li class="nav-item d-lg-none"><a class="nav-link " href="/en/parameters">@lang('index.parameters')</a></li>
                <hr class="bar-menu nav-item d-lg-none">
                <form action="{{route('auth.logout')}}" method="post" class="nav-item d-lg-none">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-link">@lang('index.logout')</button>
                </form>
            </ul>
        </nav>
    </div>
    <div class="overlay"></div>
    <!-- Contenu mail -->
    <article>
    <ul>
        @forelse($trashesEmails as $email)
            <div class="row">
                <div class="col">
                    <div class="form-check" id="{{ $email->id }}">
                        <input class="form-check-input" type="checkbox" value="" id="$email">
                        <label class="form-check-label" for="$email">
                            {{ $email->id }}
                        </label>
                    </div>
                </div>
                <div class="col">{{ $email->from_user_id }}</div>
                <div class="col">{{ $email->subject }}</div>
                <div class="col">{{ $email->sent_at }}</div>
                <div class="col">
                    <form action="/remove-from-trashes" method="post">
                        @csrf
                        <input type="hidden" name="emailId" value="{{ $email->id }}">
                        <button type="submit" class="btn btn-outline-primary">@lang('Restore Email')</button>
                    </form>
                    <form action="/delete-email" method="post">
                        @csrf
                        <input type="hidden" name="emailId" value="{{ $email->id }}">
                        <button type="submit" class="btn btn-outline-danger">@lang('Delete Permanently')</button>
                    </form>
                </div>
            </div>
            <hr>
        @empty
            <h2 class='text-center'>@lang('index.empty')</h2
            <div class="testeu">
                <img style='; width: 500px;' src='http://127.0.0.1:8000/images/mail.png' class='img-fluid' alt='@lang('No messages')'>
            </div>
        @endforelse
        </ul>
    </article>
    <button class="btn btn-primary mt-3 static">@lang('New Message')</button>

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
</main>
</body>
</html>
