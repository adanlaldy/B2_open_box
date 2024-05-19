<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boîte de réception - Open Box</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="http://127.0.0.1:8000/css/mail.css" rel="stylesheet" />
</head>

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
<body>
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
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success " type="submit">Search</button>
            </div>
        </form>

        <div class="navbar-nav d-lg-flex flex-row align-items-center">
            <ul class="navbar-nav d-flex flex-row">
                <li class="nav-item d-lg-block d-none"><a class="nav-link" href="/offers">Abonnement</a></li>
                <li class="nav-item d-lg-block d-none"><a class="nav-link" href="/parameters">Paramètres</a></li>
                <li class="nav-item d-lg-block d-none"><a class="nav-link" href="/account">Compte</a></li>
            </ul>
            <form action="{{route('auth.logout')}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-link nav-item d-lg-block d-none">Logout</button>
            </form>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
    <nav>
        <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none margin-20" href="/inbox">Open Box <?php echo Auth::user()->email; ?></a>
        <hr class="bar-menu">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item d-lg-none"><a class="nav-link" href="/offers">Abonnement</a></li>
            <hr class="bar-menu nav-item d-lg-none">
            <li class="nav-item"><a class="nav-link" href="/inbox">Boîte de réception</a></li>
            <li><a class="nav-link link-body-emphasis" href="/draft">Brouillons</a></li>
            <li><a class="nav-link link-body-emphasis" href="/sent">Messages envoyés</a></li>
            <li><a class="nav-link link-body-emphasis" href="/starred">Favoris</a></li>
            <li><a class="nav-link link-body-emphasis" href="/archive">Archives</a></li>
            <li><a class="nav-link link-body-emphasis" href="/spam">Spams</a></li>
            <li><a class="nav-link" href="/trash">Corbeille</a></li>
            <li><a class="nav-link link-body-emphasis" href="/all_mail">Tous les messages</a></li>
            <hr class="bar-menu nav-item d-lg-none">
            <li class="nav-item d-lg-none"><a class="nav-link " href="/parameters">Paramètres</a></li>
            <hr class="bar-menu nav-item d-lg-none">
            <form action="{{route('auth.logout')}}" method="post" class="nav-item d-lg-none">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-link">Logout</button>
            </form>
        </ul>
    </nav>
</div>
<div class="overlay"></div>

<!-- Contenu mail -->
<div class="content">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-lg border-0 bg-light" onclick="openPaymentModal('Personal+', '2.99€ / mois')">
                <div class="card-body">
                    <h1 class="card-title text-primary">Personal+</h1>
                    <p class="card-text">2.99€ / mois</p>
                    <p class="card-text">Stockage 2GB</p>
                    <p class="card-text">Assistance 24/7</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-lg border-0 bg-light" onclick="openPaymentModal('Professional+', '5.99€ / mois')">
                <div class="card-body">
                    <h1 class="card-title text-primary">Professional+</h1>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
</script>
</body>
</html>
