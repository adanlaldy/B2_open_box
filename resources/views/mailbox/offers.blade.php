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
                        <li class="nav-item d-lg-block d-none"><a class="nav-link top" href="/{{ Session::get('locale', app()->getLocale()) }}/offers"><i class="fi fi-sr-wallet"></i>@lang('index.subscription')</a></li>
                        <li class="nav-item d-lg-block d-none"><a class="nav-link top" href="/{{ Session::get('locale', app()->getLocale()) }}/parameters"><i class="fi fi-ss-settings"></i>@lang('index.parameters')</a></li>
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
            <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto nav-link margin-20" href="/{{ Session::get('locale', app()->getLocale()) }}/inbox"><img class="logo" width="50px" style="margin: 0 30px 0 0; border-radius: 20%" src="http://127.0.0.1:8000/images/open_box_logo.png" alt="logo"> {{ $user->email }}</a>
            <hr class="bar-menu">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item d-lg-none"><a class="nav-link color1 margin-20" href="/{{ Session::get('locale', app()->getLocale()) }}/offers"><i class="fi fi-sr-wallet"></i>@lang('index.subscription')</a></li> <!-- Ajout de la classe "d-lg-none" pour cacher en mode PC -->
                <hr class="bar-menu nav-item d-lg-none">
                <li class="nav-item"><a class="nav-link color1" href="/{{ Session::get('locale', app()->getLocale()) }}/inbox"><i class="fi fi-sr-envelope-open"></i>@lang('index.inbox')</a></li>
                <li><a class="nav-link color1" href="/{{ Session::get('locale', app()->getLocale()) }}/drafts"><i class="fi fi-ss-edit"></i>@lang('index.draft')</a></li>
                <li><a class="nav-link color1" href="/{{ Session::get('locale', app()->getLocale()) }}/sents"><i class="fi fi-ss-paper-plane"></i>@lang('index.sent')</a></li>
                <li><a class="nav-link color1" href="/{{ Session::get('locale', app()->getLocale()) }}/starreds"><i class="fi fi-sr-star"></i>@lang('index.star')</a></li>
                <li><a class="nav-link color1" href="/{{ Session::get('locale', app()->getLocale()) }}/archives"><i class="fi fi-sr-bookmark"></i>@lang('index.archive')</a></li>
                <li><a class="nav-link color1" href="/{{ Session::get('locale', app()->getLocale()) }}/spams"><i class="fi fi-ss-shield-exclamation"></i>@lang('index.spam')</a></li>
                <li><a class="nav-link color1" href="/{{ Session::get('locale', app()->getLocale()) }}/trashes"><i class="fi fi-sr-trash"></i>@lang('index.trash')</a></li>
                <li><a class="nav-link color1" href="/{{ Session::get('locale', app()->getLocale()) }}/all-emails"><i class="fi fi-sr-apps"></i>@lang('index.all_mail')</a></li>
                <hr class="bar-menu nav-item d-lg-none">
                <li class="nav-item d-lg-none"><a class="nav-link color1" href="/{{ Session::get('locale', app()->getLocale()) }}/parameters"><i class="fi fi-ss-settings"></i>@lang('index.parameters')</a></li>
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
<style>
    .card:hover {
        transform: scale(1.05);
        transition: transform 0.2s ease-in-out;
    }

    .card {
        margin: 50px;
        text-align: center;
        cursor: pointer;
        width: 300px;
        border-radius: 25px;
    }
</style>
<!-- Contenu mail -->
<div class="content">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-lg border-0 bg-light" onclick="openPaymentModal('Personal+', '2.99€ / mois')">
                <div class="card-body">
                    <h1 class="card-title txt-color1">Personal+</h1>
                    <p class="card-text">2.99€ / mois</p>
                    <p class="card-text">Stockage 2GB</p>
                    <p class="card-text">Assistance 24/7</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-lg border-0 bg-light" onclick="openPaymentModal('Professional+', '5.99€ / mois')">
                <div class="card-body">
                    <h1 class="card-title txt-color1">Professional+</h1>
                    <p class="card-text">5.99€ / mois</p>
                    <p class="card-text">Stockage 10GB</p>
                    <p class="card-text">Assistance 24/7</p>
                    <p class="card-text">Nom de domaine personnalisable</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close"></button>
            </div>
            <div class="modal-body">
                <h5 id="plan-name"></h5>
                <p id="plan-price"></p>
                <form id="payment-form">
                    <div id="card-element"></div>
                    <button type="submit" class="btn btn-primary mt-3">Pay</button>
                </form>
            </div>
        </div>
    </div>
</div>
</main>

<!-- Bootstrap JS et dépendances -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('stripe-public-key');
    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    function openPaymentModal(planName, planPrice) {
        document.getElementById('plan-name').innerText = planName;
        document.getElementById('plan-price').innerText = planPrice;
        const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
        paymentModal.show();
    }

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const { error, paymentMethod } = await stripe.createPaymentMethod('card', cardElement);

        if (error) {
            console.error(error);
        } else {
            // Handle successful payment method creation
            console.log('Payment method created:', paymentMethod);
            // Here you can send the payment method ID to your server for further processing
        }
    });

    const close = document.getElementById('close');
    close.addEventListener('click', function() {
        document.getElementById('paymentModal').style.display = 'none';

        document.querySelector('.modal-backdrop.fade.show').classList.remove('show');

    });


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
