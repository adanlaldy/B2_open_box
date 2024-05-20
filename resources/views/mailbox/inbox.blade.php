<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('index.title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="http://127.0.0.1:8000/css/mail.css" rel="stylesheet" />
    <link href="http://127.0.0.1:8000/css/colors.css" rel="stylesheet" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
</head>
<body>
<main>
    <div class="static-top">
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
                <form class="form-inline my-2 my-lg-0 mx-auto">
                    <div class="input-group center">
                        <input class="form-control mr-sm-2" type="search" placeholder="@lang('index.search_placeholder')" aria-label="@lang('index.search_placeholder')">
                        <button class="btn btn-outline-success " type="submit">@lang('index.search_button')</button>
                    </div>
                </form>

                <div class="navbar-nav d-lg-flex flex-row align-items-center">
                    <ul class="navbar-nav d-flex flex-row">
                        <li class="nav-item d-lg-block d-none"><a class="nav-link top" href="/en/offers"><i class="fi fi-sr-wallet"></i>@lang('index.subscription')</a></li>
                        <li class="nav-item d-lg-block d-none"><a class="nav-link top" href="/en/parameters"><i class="fi fi-ss-settings"></i>@lang('index.parameters')</a></li>
                    </ul>
                    <form action="{{route('auth.logout')}}" method="post" class="d-none">
                        @csrf
                        @method('delete')
                        <button type="submit" class="nav-link me-4 top"><i class="fi fi-sr-exit"></i>@lang('index.logout')</button>
                    </form>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-light bg-light color3 p-0">
            <div class="container-fluid d-flex justify-content-between align-items-center container-fluid-custom color3 p-0">
                <h1 class="form-inline my-2 my-lg-0 margin-50">@lang('index.inbox')</h1>
            </div>
        </nav>
    </div>
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
            <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto nav-link margin-20" href="/en/inbox"><img class="logo" width="50px" style="margin: 0 30px 0 0; border-radius: 20%" src="http://127.0.0.1:8000/images/open_box_logo.png" alt="logo"> {{ $user->email }}</a>
            <hr class="bar-menu">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item d-lg-none"><a class="nav-link color1 margin-20" href="/en/offers"><i class="fi fi-sr-wallet"></i>@lang('index.subscription')</a></li> <!-- Ajout de la classe "d-lg-none" pour cacher en mode PC -->
                <hr class="bar-menu nav-item d-lg-none">
                <li class="nav-item"><a class="nav-link color1" href="/en/inbox"><i class="fi fi-sr-envelope-open"></i>@lang('index.inbox')</a></li>
                <li><a class="nav-link color1" href="/en/drafts"><i class="fi fi-ss-edit"></i>@lang('index.draft')</a></li>
                <li><a class="nav-link color1" href="/en/sents"><i class="fi fi-ss-paper-plane"></i>@lang('index.sent')</a></li>
                <li><a class="nav-link color1" href="/en/starreds"><i class="fi fi-sr-star"></i>@lang('index.star')</a></li>
                <li><a class="nav-link color1" href="/en/archives"><i class="fi fi-sr-bookmark"></i>@lang('index.archive')</a></li>
                <li><a class="nav-link color1" href="/en/spams"><i class="fi fi-ss-shield-exclamation"></i>@lang('index.spam')</a></li>
                <li><a class="nav-link color1" href="/en/trashes"><i class="fi fi-sr-trash"></i>@lang('index.trash')</a></li>
                <li><a class="nav-link color1" href="/en/all-emails"><i class="fi fi-sr-apps"></i>@lang('index.all_mail')</a></li>
                <hr class="bar-menu nav-item d-lg-none">
                <li class="nav-item d-lg-none"><a class="nav-link color1" href="/en/parameters"><i class="fi fi-ss-settings"></i>@lang('index.parameters')</a></li>
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
    <!-- Contenu mail -->
    <article class="content">
        <ul>
            @forelse($inboxEmails as $email)
                <div class="row">
                    <div class="col p-0">
                        <div class="form-check" id="{{ $email->id }}">
                            <input class="form-check-input" type="checkbox" value="" id="$email">
                            <label class="form-check-label" for="$email">
                                {{ $email->id }}
                            </label>
                        </div>
                    </div>
                    <div class="col">{{ $email->from_user_id }}</div>
                    <div class="col"><button id="emailDetails">{{ $email->subject }}</button></div>
                    <div class="col">{{ $email->sent_at }}</div>
                    <div class="col w-auto p-0">
                        <form action="/add-to-starreds" method="post">
                            @csrf
                            <input type="hidden" name="email_id" value="{{ $email->id }}">
                            <button type="submit" class="btn btn-outline-primary">@lang('index.starred')</button>
                        </form>
                        <form action="/add-to-archives" method="post">
                            @csrf
                            <input type="hidden" name="email_id" value="{{ $email->id }}">
                            <button type="submit" class="btn btn-outline-info">@lang('index.archived')</button>
                        </form>
                        <form action="/add-to-trashes" method="post">
                            @csrf
                            <input type="hidden" name="email_id" value="{{ $email->id }}">
                            <button type="submit" class="btn btn-outline-danger">@lang('index.delete')</button>
                        </form>
                    </div>
                </div>
                <hr>
                <!-- email details -->
                <dialog id="dialogEmailDetails" class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Email Details')</h5>
                        <button type="button" id="closeEmailDetails" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="from">@lang('index.sender') :</label>
                            <input name="fromEmail" type="email" class="form-control" id="from" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="to">@lang('index.recipient') :</label>
                            <input name="toEmail" type="email" class="form-control" id="to" placeholder="@lang('index.email_address')">
                        </div>
                        <div class="form-group">
                            <label for="cc">@lang('index.cc') :</label>
                            <input name="ccEmail" type="email" class="form-control" id="cc" placeholder="@lang('index.email_address')">
                        </div>
                        <div class="form-group">
                            <label for="bcc">@lang('index.bcc') :</label>
                            <input name="bccEmail" type="email" class="form-control" id="bcc" placeholder="@lang('index.email_address')">
                        </div>
                        <div class="form-group">
                            <label for="subject">@lang('index.subject') :</label>
                            <input name="subject" type="text" class="form-control" id="subject" placeholder="@lang('index.email_subject')">
                        </div>
                        <div class="form-group">
                            <label for="content">@lang('index.content') :</label>
                            <textarea name="content" class="form-control" id="content" rows="5" placeholder="@lang('index.email_content')"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('index.close')</button>
                        <button type="button" class="btn btn-primary">@lang('index.send')</button>
                    </div>
                </div>
            </dialog>
            @empty
                <h2 class='text-center'>@lang('index.empty')</h2>
                <div class="testeu">
                    <img style='width: 500px;' src='http://127.0.0.1:8000/images/mail.png' class='img-fluid' alt='@lang('index.no_message')'>
                </div>
            @endforelse
        </ul>
    </article>
    <button class="btn btn-primary mt-3 static color1" id="newEmail">@lang('index.new_email')</button>
    <dialog id="dialogNewEmail">
        <div class="container mt-3">
            <h3>@lang('index.new_email_title')</h3>
            <form action="/post-email" method="post">
                @csrf
                <div class="form-group">
                    <label for="from">@lang('index.sender') :</label>
                    <input name="fromEmail" type="email" class="form-control" id="from" value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="to">@lang('index.recipient') :</label>
                    <input name="toEmail" type="email" class="form-control" id="to" placeholder="@lang('index.email_address')">
                </div>
                <div class="form-group">
                    <label for="cc">@lang('index.cc') :</label>
                    <input name="ccEmail" type="email" class="form-control" id="cc" placeholder="@lang('index.email_address')">
                </div>
                <div class="form-group">
                    <label for="bcc">@lang('index.bcc') :</label>
                    <input name="bccEmail" type="email" class="form-control" id="bcc" placeholder="@lang('index.email_address')">
                </div>
                <div class="form-group">
                    <label for="subject">@lang('index.subject') :</label>
                    <input name="subject" type="text" class="form-control" id="subject" placeholder="@lang('index.email_subject')">
                </div>
                <div class="form-group">
                    <label for="content">@lang('index.content') :</label>
                    <textarea name="content" class="form-control" id="content" rows="5" placeholder="@lang('index.email_content')"></textarea>
                </div>

                <button type="submit" class="btn btn-primary m-2 color2">@lang('index.send')</button>
                <button class="btn btn-primary m-2 color2" id="close_email">@lang('index.close')</button>
            </form>
        </div>
    </dialog>

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

        // open or close the dialog for email details
        const dialogEmailDetails = document.getElementById('dialogEmailDetails');
        const emailDetails = document.querySelectorAll('[id="emailDetails"]');
        const closeEmailDetails = document.getElementById('closeEmailDetails');

        emailDetails.forEach(function(element) {
            element.addEventListener('click', function() {
                dialogEmailDetails.showModal();
            });
        });

        // closeEmailDetails.addEventListener('click', function() {
        //     dialogEmailDetails.close();
        // });


        // open or close the dialog for new email
        const dialogNewEmail = document.getElementById('dialogNewEmail');
        const newEmail = document.getElementById('newEmail');
        const closeNewEmail = document.getElementById('closeNewEmail');

        newEmail.addEventListener('click', function() {
            console.log("new email");
            dialogNewEmail.showModal();
        });

        closeNewEmail.addEventListener('click', function() {
            dialogNewEmail.close();
        });
    </script>
</main>
</body>
</html>
