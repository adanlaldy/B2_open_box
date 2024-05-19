<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription</title>
    <!-- Inclusion de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card:hover {
            transform: scale(1.05);
            transition: transform 0.2s ease-in-out;
        }

        .card {
            cursor: pointer;
            border-radius: 25px;
        }
    </style>
</head>
<body>
<main class="container my-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-lg border-0  bg-light h-100">
                <div class="card-body">
                    <h1 class="card-title text-primary">Personal+</h1>
                    <p class="card-text">2.99€ / mois</p>
                    <p class="card-text">Stockage 2GB</p>
                    <p class="card-text">Assistance 24/7</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-lg border-0 bg-light h-100">
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
</main>
<!-- Inclusion de Bootstrap JS et dépendances (optionnel, pour des fonctionnalités avancées) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
